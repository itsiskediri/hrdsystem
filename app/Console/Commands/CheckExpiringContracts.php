<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\User;
use App\Notifications\ContractExpiringNotification;
use Illuminate\Console\Command;

class CheckExpiringContracts extends Command
{
    protected $signature = 'contracts:check-expiring';
    protected $description = 'Cek kontrak pegawai yang akan habis dan kirim notifikasi';

    public function handle(): int
    {
        $employees = Employee::query()
            ->whereNotNull('contract_end_date')
            ->get()
            ->filter(function ($employee) {
                return !is_null($employee->days_until_contract_end)
                    && $employee->days_until_contract_end >= 0
                    && $employee->days_until_contract_end <= ($employee->contract_reminder_days ?? 30);
            });

        $users = User::all();

        foreach ($employees as $employee) {
            foreach ($users as $user) {
                $alreadySentToday = $user->notifications()
                    ->where('type', ContractExpiringNotification::class)
                    ->whereDate('created_at', today())
                    ->where('data->employee_id', $employee->id)
                    ->exists();

                if (!$alreadySentToday) {
                    $user->notify(new ContractExpiringNotification($employee));
                }
            }
        }

        $this->info('Reminder kontrak selesai diproses.');

        return self::SUCCESS;
    }
}