<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'institution',
        'employee_number',
        'name',
        'gender',
        'birth_place',
        'birth_date',
        'position',
        'postal_code',
        'ktp_number',
        'kk_number',
        'contract_number',
        'address',
        'religion',
        'education',
        'level',
        'major',
        'phone',
        'mother_name',
        'email',
        'work_email',
        'npwp',
        'tax_status',
        'npwp_integrated_with_ktp',
        'marital_status',
        'bpjs_health',
        'bpjs_employment',
        'bank_name',
        'bank_account_number',
        'employment_status',
        'contract_start_date',
        'contract_end_date',
        'permanent_date',
        'personal_document_path',
        'photo_path',
        'contract_reminder_days',
        'notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'contract_start_date' => 'date',
        'contract_end_date' => 'date',
        'permanent_date' => 'date',
        'npwp_integrated_with_ktp' => 'boolean',
        'contract_reminder_days' => 'integer',
    ];

    protected $appends = [
        'photo_url',
        'days_until_contract_end',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        if (! $this->photo_path) {
            return null;
        }

        if (! Storage::disk('public')->exists($this->photo_path)) {
            return null;
        }

        return Storage::disk('public')->url($this->photo_path);
    }

    public function getDaysUntilContractEndAttribute(): ?int
    {
        if (! $this->contract_end_date) {
            return null;
        }

        return now()->diffInDays($this->contract_end_date, false);
    }
}