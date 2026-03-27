@extends('layouts.hrd')

@section('title', __('Employee Detail'))

@section('content')
    <div class="space-y-6">
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] p-6 text-white shadow-2xl">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-[#F5A623]/20 blur-3xl"></div>
            <div class="absolute -bottom-10 left-0 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-4">
                    <div class="h-24 w-24 overflow-hidden rounded-3xl bg-white/15 ring-1 ring-white/20">
                        @if($employee->photo_url)
                            <img src="{{ $employee->photo_url }}" alt="{{ $employee->name }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full items-center justify-center text-3xl font-black text-white">
                                {{ strtoupper(mb_substr($employee->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <p class="inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 backdrop-blur">
                            {{ __('Employee Detail') }}
                        </p>
                        <h2 class="mt-3 text-3xl font-black leading-tight">{{ $employee->name }}</h2>
                        <p class="mt-1 text-sm text-white/85">
                            {{ $employee->position ?: __('Position not filled') }}
                        </p>

                        <div class="mt-3 flex flex-wrap gap-2">
                            @if($employee->employee_number)
                                <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/90">
                                    No. Karyawan: {{ $employee->employee_number }}
                                </span>
                            @endif

                            @if($employee->institution)
                                <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white/90">
                                    Lembaga: {{ $employee->institution }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('employees.index') }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                        {{ __('Back to Employees') }}
                    </a>

                    <a href="{{ route('employees.edit', $employee) }}"
                       class="inline-flex items-center justify-center rounded-2xl bg-[#F5A623] px-4 py-3 text-sm font-bold text-slate-900 shadow-lg transition hover:scale-[1.02] hover:bg-[#e59a12]">
                        {{ __('Edit') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-12">
            <div class="xl:col-span-8">
                <div class="rounded-[30px] border border-slate-200 bg-white p-6 shadow-xl">
                    <div class="mb-5">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">Format Excel</p>
                        <h3 class="mt-2 text-2xl font-bold text-[#243B73]">Data Utama Pegawai</h3>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">Lembaga</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->institution ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">Profesi</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->position ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">No. Karyawan</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->employee_number ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">Nama</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->name ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">Jenis Kelamin</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">
                                @if($employee->gender === 'L')
                                    Laki-Laki
                                @elseif($employee->gender === 'P')
                                    Perempuan
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Place, Date of Birth') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">
                                {{ $employee->birth_place ?: '-' }}{{ $employee->birth_date ? ', '.$employee->birth_date->format('d-m-Y') : '' }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Religion') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->religion ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">Kode Pos</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->postal_code ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4 md:col-span-2">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Address') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->address ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('ID Number') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->ktp_number ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Family Card Number') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->kk_number ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">No. Kontrak</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->contract_number ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Contract Start') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->contract_start_date?->format('d-m-Y') ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Contract End') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->contract_end_date?->format('d-m-Y') ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Education') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->education ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Level') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->level ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Major') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->major ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Phone') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->phone ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('NPWP') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->npwp ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('BPJS Health') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->bpjs_health ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('BPJS Employment') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->bpjs_employment ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Bank') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->bank_name ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Bank Account Number') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->bank_account_number ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Mother Name') }}</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->mother_name ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">Alamat Email</p>
                            <p class="mt-2 break-all text-base font-semibold text-slate-800">{{ $employee->email ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">Email Inspirasi</p>
                            <p class="mt-2 break-all text-base font-semibold text-slate-800">{{ $employee->work_email ?: '-' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4 md:col-span-2">
                            <p class="text-sm font-semibold text-slate-500">Status Pajak</p>
                            <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->tax_status ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-4">
                <div class="space-y-6">
                    <div class="rounded-[30px] border border-slate-200 bg-white p-6 shadow-xl">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">Tambahan Sistem</p>
                        <h3 class="mt-2 text-2xl font-bold text-[#243B73]">Informasi HRD</h3>

                        <div class="mt-5 space-y-4">
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-semibold text-slate-500">{{ __('NPWP-KTP Integration') }}</p>
                                <p class="mt-2 text-base font-semibold text-slate-800">
                                    {{ $employee->npwp_integrated_with_ktp ? __('Integrated') : __('Not Integrated') }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-semibold text-slate-500">{{ __('Marital Status') }}</p>
                                <p class="mt-2 text-base font-semibold text-slate-800">
                                    @if($employee->marital_status === 'kawin')
                                        {{ __('Married') }}
                                    @elseif($employee->marital_status === 'belum_kawin')
                                        {{ __('Single') }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-semibold text-slate-500">{{ __('Employment Status') }}</p>
                                <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->employment_status ?: '-' }}</p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-semibold text-slate-500">Reminder Kontrak</p>
                                <p class="mt-2 text-base font-semibold text-slate-800">
                                    {{ $employee->contract_reminder_days ? $employee->contract_reminder_days.' hari' : '-' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-semibold text-slate-500">{{ __('Permanent Date') }}</p>
                                <p class="mt-2 text-base font-semibold text-slate-800">{{ $employee->permanent_date?->format('d-m-Y') ?: '-' }}</p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-semibold text-slate-500">Keterangan</p>
                                <p class="mt-2 text-base font-semibold text-slate-800 whitespace-pre-line">{{ $employee->notes ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($employee->personal_document_path)
                        <div class="rounded-[30px] border border-slate-200 bg-white p-6 shadow-xl">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">Dokumen</p>
                            <h3 class="mt-2 text-2xl font-bold text-[#243B73]">Arsip Pegawai</h3>

                            <div class="mt-5">
                                <a href="{{ route('employees.document', $employee) }}"
                                   class="inline-flex w-full items-center justify-center rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">
                                    {{ __('Download Personal PDF') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection