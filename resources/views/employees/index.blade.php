@extends('layouts.hrd')

@section('title', __('Employee Data'))

@section('content')
    <div class="space-y-6">
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] p-6 text-white shadow-2xl">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-[#F5A623]/20 blur-3xl"></div>
            <div class="absolute -bottom-10 left-0 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <p class="inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 backdrop-blur">
                        {{ __('Employee Management') }}
                    </p>

                    <h2 class="mt-4 text-3xl font-black leading-tight md:text-4xl">
                        {{ __('Employee Data') }}
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-white/90 md:text-base">
                        {{ __('Manage employee records, work contracts, personal documents, and personnel administration in one clean and modern page.') }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('employees.create') }}"
                       class="inline-flex items-center justify-center rounded-2xl bg-[#F5A623] px-5 py-3 text-sm font-bold text-slate-900 shadow-lg transition hover:scale-[1.02] hover:bg-[#e59a12]">
                        + {{ __('Add Employee') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="rounded-[30px] border border-slate-200 bg-white p-4 shadow-xl md:p-5">
            <form method="GET" class="flex flex-col gap-3 md:flex-row">
                <div class="relative flex-1">
                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>

                    <input
                        type="text"
                        name="q"
                        value="{{ $q }}"
                        placeholder="Cari nama, profesi, no. karyawan, email, atau nomor KTP..."
                        class="w-full rounded-2xl border-2 border-slate-300 bg-white py-3 pl-12 pr-4 text-sm font-medium text-slate-800 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-[#243B73] focus:ring-4 focus:ring-[#243B73]/10"
                    >
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#243B73] to-[#B61C66] px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:opacity-95">
                    {{ __('Search') }}
                </button>

                @if(request('q'))
                    <a href="{{ route('employees.index') }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        {{ __('Reset') }}
                    </a>
                @endif
            </form>
        </div>

        <div class="grid gap-4">
            @forelse($employees as $employee)
                @php
                    $daysLeft = $employee->days_until_contract_end;
                    $expiringSoon = !is_null($daysLeft) && $daysLeft >= 0 && $daysLeft <= ($employee->contract_reminder_days ?? 30);

                    $contractBadgeClass = 'bg-slate-100 text-slate-700';
                    if ($expiringSoon && $daysLeft <= 7) {
                        $contractBadgeClass = 'bg-rose-100 text-rose-700';
                    } elseif ($expiringSoon) {
                        $contractBadgeClass = 'bg-amber-100 text-amber-700';
                    }

                    $genderLabel = '-';
                    if (($employee->gender ?? null) === 'L') {
                        $genderLabel = 'Laki-Laki';
                    } elseif (($employee->gender ?? null) === 'P') {
                        $genderLabel = 'Perempuan';
                    }
                @endphp

                <div class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-xl shadow-slate-200/50 transition hover:-translate-y-0.5 hover:shadow-2xl">
                    <div class="p-4 md:p-5">
                        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                            <div class="flex gap-4">
                                <div class="h-20 w-20 shrink-0 overflow-hidden rounded-[24px] bg-gradient-to-br from-[#243B73]/10 to-[#B61C66]/10 ring-1 ring-slate-200">
                                    @if($employee->photo_url)
                                        <img src="{{ $employee->photo_url }}" alt="{{ $employee->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-2xl font-black text-[#243B73]">
                                            {{ strtoupper(mb_substr($employee->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-xl font-black text-slate-900">
                                            {{ $employee->name }}
                                        </h3>

                                        @if($employee->employee_number)
                                            <span class="rounded-full bg-[#243B73]/10 px-3 py-1 text-xs font-semibold text-[#243B73]">
                                                {{ __('No. Karyawan') }}: {{ $employee->employee_number }}
                                            </span>
                                        @endif

                                        <span class="rounded-full bg-[#B61C66]/10 px-3 py-1 text-xs font-semibold text-[#B61C66]">
                                            {{ $employee->employment_status ?: __('Status not filled') }}
                                        </span>

                                        @if($expiringSoon)
                                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $contractBadgeClass }}">
                                                {{ __('Contract') }}: {{ __(':days days left', ['days' => $daysLeft]) }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="mt-2 text-sm font-medium text-slate-500">
                                        {{ $employee->position ?: __('Position not filled') }}
                                    </p>

                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @if($employee->institution)
                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                                {{ __('Lembaga') }}: {{ $employee->institution }}
                                            </span>
                                        @endif

                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                            {{ __('Jenis Kelamin') }}: {{ $genderLabel }}
                                        </span>
                                    </div>

                                    <div class="mt-4 grid gap-2 text-sm text-slate-600 md:grid-cols-2 xl:grid-cols-3">
                                        <p>
                                            <span class="font-semibold text-slate-700">{{ __('Phone') }}:</span>
                                            {{ $employee->phone ?: '-' }}
                                        </p>
                                        <p>
                                            <span class="font-semibold text-slate-700">{{ __('Email') }}:</span>
                                            {{ $employee->email ?: '-' }}
                                        </p>
                                        <p>
                                            <span class="font-semibold text-slate-700">{{ __('Email Inspirasi') }}:</span>
                                            {{ $employee->work_email ?: '-' }}
                                        </p>
                                        <p>
                                            <span class="font-semibold text-slate-700">{{ __('ID Number') }}:</span>
                                            {{ $employee->ktp_number ?: '-' }}
                                        </p>
                                        <p>
                                            <span class="font-semibold text-slate-700">{{ __('No. Kontrak') }}:</span>
                                            {{ $employee->contract_number ?: '-' }}
                                        </p>
                                        <p>
                                            <span class="font-semibold text-slate-700">{{ __('Contract End') }}:</span>
                                            {{ $employee->contract_end_date?->format('d M Y') ?: '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 xl:w-auto xl:justify-end">
                                @if($employee->personal_document_path)
                                    <a href="{{ route('employees.document', $employee) }}"
                                       class="inline-flex items-center justify-center rounded-2xl bg-emerald-100 px-4 py-3 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-200">
                                        PDF
                                    </a>
                                @endif

                                <a href="{{ route('employees.show', $employee) }}"
                                   class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                    {{ __('Details') }}
                                </a>

                                <a href="{{ route('employees.edit', $employee) }}"
                                   class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#243B73] to-[#B61C66] px-4 py-3 text-sm font-semibold text-white shadow transition hover:opacity-95">
                                    {{ __('Edit') }}
                                </a>

                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('{{ __('Delete this employee record?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center rounded-2xl bg-rose-100 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-200">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-[30px] border border-dashed border-slate-300 bg-white p-10 text-center shadow-lg">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#243B73]/10 text-[#243B73]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7V6a2 2 0 00-2-2H8a2 2 0 00-2 2v1m12 0H6m12 0v11a2 2 0 01-2 2H8a2 2 0 01-2-2V7" />
                        </svg>
                    </div>

                    <h3 class="mt-4 text-xl font-bold text-slate-800">{{ __('No employee data yet') }}</h3>
                    <p class="mt-2 text-sm text-slate-500">
                        {{ __('Add the first employee data to start managing HR administration.') }}
                    </p>

                    <a href="{{ route('employees.create') }}"
                       class="mt-5 inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#243B73] to-[#B61C66] px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:opacity-95">
                        + {{ __('Add Employee') }}
                    </a>
                </div>
            @endforelse
        </div>

        <div class="rounded-[24px] border border-slate-200 bg-white p-4 shadow-lg">
            {{ $employees->links() }}
        </div>
    </div>
@endsection