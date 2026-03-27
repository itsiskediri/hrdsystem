<?php

namespace App\Notifications;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContractExpiringNotification extends Notification
{
    use Queueable;

    public function __construct(public Employee $employee)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'employee_id' => $this->employee->id,
            'employee_name' => $this->employee->name,
            'position' => $this->employee->position,
            'contract_end_date' => optional($this->employee->contract_end_date)->format('Y-m-d'),
            'days_left' => $this->employee->days_until_contract_end,
            'message' => 'Kontrak pegawai '.$this->employee->name.' akan berakhir dalam '.$this->employee->days_until_contract_end.' hari.',
        ];
    }
}