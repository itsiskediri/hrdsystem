<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::redirect('/home', '/');

Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['id', 'en'])) {
        abort(404);
    }

    session(['locale' => $locale]);

    return back();
})->name('language.switch');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', function () {
        $expiringEmployees = Employee::query()
            ->whereNotNull('contract_end_date')
            ->whereDate('contract_end_date', '>=', today())
            ->whereDate('contract_end_date', '<=', today()->addDays(30))
            ->orderBy('contract_end_date')
            ->take(10)
            ->get();

        return view('dashboard', [
            'totalEmployees' => Employee::count(),
            'contractEmployees' => Employee::where('employment_status', 'kontrak')->count(),
            'permanentEmployees' => Employee::where('employment_status', 'tetap')->count(),
            'expiringEmployees' => $expiringEmployees,
        ]);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/backups', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backups', [BackupController::class, 'store'])->name('backup.store');
    Route::get('/backups/download/{filename}', [BackupController::class, 'download'])
        ->where('filename', '.*')
        ->name('backup.download');

    Route::get('/employees/{employee}/document', [EmployeeController::class, 'downloadDocument'])
        ->name('employees.document');

    Route::resource('employees', EmployeeController::class);
});