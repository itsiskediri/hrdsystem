<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee')?->id;

        return [
            'institution' => ['nullable', 'string', 'max:255'],
            'employee_number' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('employees', 'employee_number')->ignore($employeeId),
            ],

            'name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', Rule::in(['L', 'P'])],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'position' => ['nullable', 'string', 'max:255'],

            'postal_code' => ['nullable', 'string', 'max:10'],

            'ktp_number' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('employees', 'ktp_number')->ignore($employeeId),
            ],
            'kk_number' => ['nullable', 'string', 'max:30'],
            'contract_number' => ['nullable', 'string', 'max:100'],

            'address' => ['nullable', 'string'],
            'religion' => ['nullable', 'string', 'max:100'],

            'education' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:100'],
            'major' => ['nullable', 'string', 'max:255'],

            'phone' => ['nullable', 'string', 'max:30'],
            'mother_name' => ['nullable', 'string', 'max:255'],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employeeId),
            ],
            'work_email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('employees', 'work_email')->ignore($employeeId),
            ],

            'npwp' => ['nullable', 'string', 'max:50'],
            'tax_status' => ['nullable', 'string', 'max:50'],

            'npwp_integrated_with_ktp' => ['nullable', 'boolean'],
            'marital_status' => ['nullable', Rule::in(['kawin', 'belum_kawin'])],

            'bpjs_health' => ['nullable', 'string', 'max:50'],
            'bpjs_employment' => ['nullable', 'string', 'max:50'],

            'bank_name' => ['nullable', 'string', 'max:100'],
            'bank_account_number' => ['nullable', 'string', 'max:100'],

            'employment_status' => ['nullable', 'string', 'max:100'],

            'contract_start_date' => ['nullable', 'date'],
            'contract_end_date' => ['nullable', 'date', 'after_or_equal:contract_start_date'],
            'permanent_date' => ['nullable', 'date'],

            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'personal_document' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],

            'contract_reminder_days' => ['nullable', 'integer', 'min:1', 'max:365'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'employee_number.unique' => 'Nomor karyawan sudah digunakan.',
            'gender.in' => 'Jenis kelamin harus L atau P.',
            'email.email' => 'Format email pribadi tidak valid.',
            'email.unique' => 'Email pribadi sudah digunakan.',
            'work_email.email' => 'Format email inspirasi tidak valid.',
            'work_email.unique' => 'Email inspirasi sudah digunakan.',
            'ktp_number.unique' => 'Nomor KTP sudah digunakan.',
            'contract_end_date.after_or_equal' => 'Akhir kontrak harus sama atau setelah awal kontrak.',
            'photo.image' => 'File foto harus berupa gambar.',
            'photo.mimes' => 'Foto harus berformat jpg, jpeg, png, atau webp.',
            'photo.max' => 'Ukuran foto maksimal 2 MB.',
            'personal_document.mimes' => 'Dokumen pribadi harus berformat PDF.',
            'personal_document.max' => 'Ukuran dokumen PDF maksimal 5 MB.',
            'contract_reminder_days.integer' => 'Reminder kontrak harus berupa angka.',
            'contract_reminder_days.min' => 'Reminder kontrak minimal 1 hari.',
            'contract_reminder_days.max' => 'Reminder kontrak maksimal 365 hari.',
            'marital_status.in' => 'Status pernikahan tidak valid.',
        ];
    }
}