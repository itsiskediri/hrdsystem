<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q'));
        $normalizedQ = Str::lower($q);

        $genderKeyword = match ($normalizedQ) {
            'l', 'lk', 'pria', 'laki', 'laki-laki', 'lakilaki' => 'L',
            'p', 'pr', 'wanita', 'perempuan' => 'P',
            default => null,
        };

        $employees = Employee::query()
            ->when($q !== '', function ($query) use ($q, $genderKeyword) {
                $query->where(function ($sub) use ($q, $genderKeyword) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('position', 'like', "%{$q}%")
                        ->orWhere('institution', 'like', "%{$q}%")
                        ->orWhere('employee_number', 'like', "%{$q}%")
                        ->orWhere('employment_status', 'like', "%{$q}%")
                        ->orWhere('ktp_number', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('work_email', 'like', "%{$q}%")
                        ->orWhere('contract_number', 'like', "%{$q}%")
                        ->orWhere('tax_status', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%");

                    if ($genderKeyword) {
                        $sub->orWhere('gender', $genderKeyword);
                    }
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('employees.index', compact('employees', 'q'));
    }

    public function create()
    {
        $employee = new Employee();

        return view('employees.create', compact('employee'));
    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $data['npwp_integrated_with_ktp'] = $request->boolean('npwp_integrated_with_ktp');
        $data['contract_reminder_days'] = $data['contract_reminder_days'] ?? 30;

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('employees/photos', 'public');
        }

        if ($request->hasFile('personal_document')) {
            $data['personal_document_path'] = $request->file('personal_document')->store('employees/documents', 'local');
        }

        Employee::create($data);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();
        $data['npwp_integrated_with_ktp'] = $request->boolean('npwp_integrated_with_ktp');
        $data['contract_reminder_days'] = $data['contract_reminder_days'] ?? 30;

        if ($request->hasFile('photo')) {
            if ($employee->photo_path && Storage::disk('public')->exists($employee->photo_path)) {
                Storage::disk('public')->delete($employee->photo_path);
            }

            $data['photo_path'] = $request->file('photo')->store('employees/photos', 'public');
        }

        if ($request->hasFile('personal_document')) {
            if ($employee->personal_document_path && Storage::disk('local')->exists($employee->personal_document_path)) {
                Storage::disk('local')->delete($employee->personal_document_path);
            }

            $data['personal_document_path'] = $request->file('personal_document')->store('employees/documents', 'local');
        }

        $employee->update($data);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo_path && Storage::disk('public')->exists($employee->photo_path)) {
            Storage::disk('public')->delete($employee->photo_path);
        }

        if ($employee->personal_document_path && Storage::disk('local')->exists($employee->personal_document_path)) {
            Storage::disk('local')->delete($employee->personal_document_path);
        }

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function downloadDocument(Employee $employee)
    {
        abort_unless(
            $employee->personal_document_path && Storage::disk('local')->exists($employee->personal_document_path),
            404
        );

        $filename = 'dokumen-' . Str::slug($employee->name ?: 'pegawai') . '.pdf';

        return Storage::disk('local')->download(
            $employee->personal_document_path,
            $filename
        );
    }
}