<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('birth_place', 255)->nullable();
            $table->date('birth_date')->nullable();

            $table->string('position', 255)->nullable();

            $table->string('ktp_number', 30)->nullable()->unique();
            $table->string('kk_number', 30)->nullable();

            $table->text('address')->nullable();
            $table->string('religion', 100)->nullable();

            $table->string('education', 100)->nullable();
            $table->string('level', 100)->nullable();
            $table->string('major', 100)->nullable();

            $table->string('phone', 30)->nullable();
            $table->string('mother_name', 255)->nullable();
            $table->string('email', 255)->nullable();

            $table->string('npwp', 50)->nullable();
            $table->boolean('npwp_integrated_with_ktp')->default(false);

            $table->enum('marital_status', ['kawin', 'belum_kawin'])->default('belum_kawin');

            $table->string('bpjs_health', 50)->nullable();
            $table->string('bpjs_employment', 50)->nullable();

            $table->string('bank_name', 100)->nullable();
            $table->string('bank_account_number', 100)->nullable();

            $table->string('employment_status', 100)->nullable();

            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable()->index();
            $table->date('permanent_date')->nullable();

            $table->string('personal_document_path', 500)->nullable();
            $table->string('photo_path', 500)->nullable();

            $table->unsignedInteger('contract_reminder_days')->default(30);
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};