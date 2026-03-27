@extends('layouts.hrd')

@section('title', __('Backup Data'))

@section('content')
    <div class="space-y-6">
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] p-6 text-white shadow-2xl">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-[#F5A623]/20 blur-3xl"></div>
            <div class="absolute -bottom-10 left-0 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <p class="inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 backdrop-blur">
                        {{ __('Backup System') }}
                    </p>

                    <h2 class="mt-4 text-3xl font-black leading-tight md:text-4xl">
                        {{ __('Backup Data') }}
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-white/90 md:text-base">
                        {{ __('Create backups of database and uploaded files to keep your HRD data safe.') }}
                    </p>
                </div>

                <form action="{{ route('backup.store') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-[#F5A623] px-5 py-3 text-sm font-bold text-slate-900 shadow-lg transition hover:scale-[1.02] hover:bg-[#e59a12]">
                        {{ __('Create Backup Now') }}
                    </button>
                </form>
            </div>
        </div>

        @if(session('backup_error'))
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700 shadow-sm">
                {{ session('backup_error') }}
            </div>
        @endif

        <div class="rounded-[30px] border border-slate-200 bg-white p-6 shadow-xl">
            <div class="mb-5">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">{{ __('Backup List') }}</p>
                <h3 class="mt-2 text-2xl font-bold text-[#243B73]">{{ __('Available Backups') }}</h3>
            </div>

            <div class="space-y-4">
                @forelse($backups as $backup)
                    <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="font-bold text-slate-800">{{ $backup['filename'] }}</p>
                            <p class="mt-1 text-sm text-slate-500">
                                {{ __('Size') }}: {{ $backup['size'] }} • {{ __('Created') }}: {{ $backup['last_modified'] }}
                            </p>
                        </div>

                        <a href="{{ route('backup.download', $backup['filename']) }}"
                           class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#243B73] to-[#B61C66] px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:opacity-95">
                            {{ __('Download Backup') }}
                        </a>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">
                        {{ __('No backup files yet.') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection