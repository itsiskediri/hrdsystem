<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('institution')->nullable()->after('id');
            $table->string('employee_number', 50)->nullable()->unique()->after('institution');
            $table->string('gender', 10)->nullable()->after('name');
            $table->string('postal_code', 10)->nullable()->after('address');
            $table->string('contract_number', 100)->nullable()->after('kk_number');
            $table->string('work_email')->nullable()->after('email');
            $table->string('tax_status', 50)->nullable()->after('npwp');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'institution',
                'employee_number',
                'gender',
                'postal_code',
                'contract_number',
                'work_email',
                'tax_status',
            ]);
        });
    }
};