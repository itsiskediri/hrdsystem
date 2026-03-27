@extends('layouts.hrd')

@section('title', __('Dashboard HRD'))

@section('content')
    @php
        $expiringCount = $expiringEmployees->count();
        $expiringPercentage = $totalEmployees > 0 ? min(100, ($expiringCount / $totalEmployees) * 100) : 0;
    @endphp

    <div class="space-y-6">
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] p-6 text-white shadow-2xl">
            <div class="absolute -left-10 top-0 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-[#F5A623]/20 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-28 w-28 rounded-full bg-white/10 blur-2xl"></div>

            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-3 rounded-full bg-white/12 px-4 py-2 text-xs font-semibold tracking-[0.2em] text-white/90 backdrop-blur">
                        <img
                            src="{{ asset('images/sispng.png') }}"
                            alt="Surya Inspirasi Schools"
                            class="h-6 w-6 object-contain"
                        >
                        <span>{{ __('Dashboard HRD') }}</span>
                    </div>

                    <h2 class="mt-5 text-3xl font-black leading-tight md:text-4xl">
                        {{ __('Welcome, :name', ['name' => auth()->user()->name ?? 'Admin HRD']) }}
                    </h2>

                    <p class="mt-3 max-w-2xl text-sm leading-6 text-white/90 md:text-base">
                        {{ __('Monitor employee data, contract periods, and personnel administration in one concise, modern dashboard aligned with Surya Inspirasi Schools branding.') }}
                    </p>

                    <div class="mt-5 flex flex-wrap gap-3">
                        <a href="{{ route('employees.index') }}"
                           class="inline-flex items-center justify-center rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                            {{ __('View Employee Data') }}
                        </a>

                        <a href="{{ route('employees.create') }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-[#F5A623] px-4 py-3 text-sm font-bold text-slate-900 shadow-lg transition hover:scale-[1.02] hover:bg-[#e59a12]">
                            + {{ __('Add Employee') }}
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 lg:min-w-[300px]">
                    <div class="rounded-3xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-white/70">{{ __('Contracts Expiring') }}</p>
                        <h3 class="mt-2 text-3xl font-black text-[#F5A623]">{{ $expiringCount }}</h3>
                        <p class="mt-1 text-xs text-white/70">{{ __('Contracts need attention') }}</p>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-white/70">{{ __('Total Employees') }}</p>
                        <h3 class="mt-2 text-3xl font-black">{{ $totalEmployees }}</h3>
                        <p class="mt-1 text-xs text-white/70">{{ __('Employees in system') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-xl shadow-slate-200/50">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">{{ __('Total Employees') }}</p>
                        <h3 class="mt-3 text-3xl font-black text-[#243B73]">{{ $totalEmployees }}</h3>
                    </div>
                    <div class="rounded-2xl bg-[#243B73]/10 p-3 text-[#243B73]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 10-6 0v4m6 0H7" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-xs font-medium text-slate-400">{{ __('Total registered employees') }}</p>
            </div>

            <div class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-xl shadow-slate-200/50">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">{{ __('Contract Employees') }}</p>
                        <h3 class="mt-3 text-3xl font-black text-[#B61C66]">{{ $contractEmployees }}</h3>
                    </div>
                    <div class="rounded-2xl bg-[#B61C66]/10 p-3 text-[#B61C66]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-10 4h6m-9 6h14a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-xs font-medium text-slate-400">{{ __('Active contract employees') }}</p>
            </div>

            <div class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-xl shadow-slate-200/50">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">{{ __('Permanent Employees') }}</p>
                        <h3 class="mt-3 text-3xl font-black text-emerald-600">{{ $permanentEmployees }}</h3>
                    </div>
                    <div class="rounded-2xl bg-emerald-100 p-3 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-xs font-medium text-slate-400">{{ __('Permanent employees') }}</p>
            </div>

            <div class="rounded-[28px] border border-slate-200 bg-white p-5 shadow-xl shadow-slate-200/50">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">{{ __('Contracts Expiring') }}</p>
                        <h3 class="mt-3 text-3xl font-black text-[#F5A623]">{{ $expiringCount }}</h3>
                    </div>
                    <div class="rounded-2xl bg-[#F5A623]/15 p-3 text-[#d08700]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.5 20h15a2 2 0 001.71-3.14l-7.5-13a2 2 0 00-3.42 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-xs font-medium text-slate-400">{{ __('Needs renewal attention') }}</p>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-12">
            <div class="xl:col-span-8">
                <div class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-xl">
                    <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-4 md:flex-row md:items-center md:justify-between md:px-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">{{ __('Monitoring') }}</p>
                            <h3 class="mt-1 text-xl font-bold text-[#243B73]">{{ __('Contracts Near Expiry') }}</h3>
                        </div>

                        <a href="{{ route('employees.index') }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-[#243B73]/10 px-4 py-2 text-sm font-semibold text-[#243B73] transition hover:bg-[#243B73]/15">
                            {{ __('See All') }}
                        </a>
                    </div>

                    <div class="p-5 md:p-6">
                        <div class="space-y-4">
                            @forelse($expiringEmployees as $employee)
                                @php
                                    $daysLeft = $employee->days_until_contract_end;
                                    $badgeClass = $daysLeft !== null && $daysLeft <= 7
                                        ? 'bg-rose-100 text-rose-700'
                                        : 'bg-amber-100 text-amber-700';
                                @endphp

                                <div class="rounded-3xl border border-slate-200 bg-gradient-to-r from-white to-slate-50 p-4 transition hover:shadow-md">
                                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                        <div class="flex items-start gap-4">
                                            <div class="flex h-14 w-14 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-md ring-1 ring-slate-200">
                                                @if($employee->photo_url)
                                                    <img src="{{ $employee->photo_url }}" alt="{{ $employee->name }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#243B73] to-[#B61C66] text-lg font-bold text-white">
                                                        {{ strtoupper(mb_substr($employee->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div>
                                                <h4 class="text-base font-bold text-slate-900">{{ $employee->name }}</h4>
                                                <p class="mt-1 text-sm text-slate-500">
                                                    {{ $employee->position ?: __('Position not filled') }}
                                                    •
                                                    {{ $employee->employment_status ?: __('Status not filled') }}
                                                </p>

                                                <div class="mt-3 flex flex-wrap gap-2">
                                                    <span class="rounded-full bg-[#243B73]/10 px-3 py-1 text-xs font-semibold text-[#243B73]">
                                                        {{ __('Contract end: :date', ['date' => $employee->contract_end_date?->format('d M Y')]) }}
                                                    </span>

                                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $badgeClass }}">
                                                        {{ __(':days days left', ['days' => $daysLeft]) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('employees.show', $employee) }}"
                                               class="rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                                {{ __('Details') }}
                                            </a>

                                            <a href="{{ route('employees.edit', $employee) }}"
                                               class="rounded-2xl bg-gradient-to-r from-[#243B73] to-[#B61C66] px-4 py-2 text-sm font-semibold text-white shadow transition hover:opacity-95">
                                                {{ __('Edit') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#243B73]/10 text-[#243B73]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m9-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h4 class="mt-4 text-lg font-bold text-slate-800">{{ __('No urgent contracts yet') }}</h4>
                                    <p class="mt-2 text-sm text-slate-500">
                                        {{ __('Currently there are no employees with contracts nearing expiry.') }}
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-4">
                <div class="rounded-[30px] border border-slate-200 bg-white p-5 shadow-xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">{{ __('Quick Actions') }}</p>
                    <h3 class="mt-2 text-xl font-bold text-[#243B73]">{{ __('HRD Menu') }}</h3>

                    <div class="mt-5 space-y-3">
                        <a href="{{ route('employees.create') }}"
                           class="flex items-center justify-between rounded-2xl bg-[#243B73]/5 px-4 py-4 transition hover:bg-[#243B73]/10">
                            <div>
                                <p class="font-semibold text-[#243B73]">{{ __('Add New Employee') }}</p>
                                <p class="text-sm text-slate-500">{{ __('Input new employee data') }}</p>
                            </div>
                            <span class="text-xl font-bold text-[#243B73]">+</span>
                        </a>

                        <a href="{{ route('employees.index') }}"
                           class="flex items-center justify-between rounded-2xl bg-[#B61C66]/5 px-4 py-4 transition hover:bg-[#B61C66]/10">
                            <div>
                                <p class="font-semibold text-[#B61C66]">{{ __('Manage Employees') }}</p>
                                <p class="text-sm text-slate-500">{{ __('View, edit, and delete employee data') }}</p>
                            </div>
                            <span class="text-xl font-bold text-[#B61C66]">→</span>
                        </a>
                    </div>

                    <div class="mt-6 rounded-3xl bg-gradient-to-br from-[#243B73] via-[#2f4b8f] to-[#B61C66] p-5 text-white shadow-lg">
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ asset('images/sispng.png') }}"
                                alt="Surya Inspirasi Schools"
                                class="h-10 w-10 rounded-2xl bg-white/10 p-1 object-contain"
                            >
                            <div>
                                <p class="text-sm font-semibold text-white/80">{{ __('Quick Summary') }}</p>
                                <h4 class="text-xl font-black">{{ __('Employee Contracts') }}</h4>
                            </div>
                        </div>

                        <h4 class="mt-4 text-3xl font-black">{{ $expiringCount }}</h4>
                        <p class="mt-2 text-sm text-white/85">
                            {{ __(':count employees need attention for contract end dates in the current monitoring period.', ['count' => $expiringCount]) }}
                        </p>

                        <div class="mt-5 h-2 overflow-hidden rounded-full bg-white/20">
                            <div class="h-full rounded-full bg-[#F5A623]" style="width: {{ $expiringPercentage }}%"></div>
                        </div>

                        <p class="mt-2 text-xs text-white/70">
                            {{ __('Percentage of active employees monitored near contract end.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection