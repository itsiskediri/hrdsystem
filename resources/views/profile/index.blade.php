@extends('layouts.hrd')

@section('title', __('Profile'))

@section('content')
    @php
        $user = auth()->user();
    @endphp

    <div class="space-y-6">
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] p-6 text-white shadow-2xl">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-[#F5A623]/20 blur-3xl"></div>
            <div class="absolute -bottom-10 left-0 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-4">
                    <div class="h-24 w-24 overflow-hidden rounded-full bg-white/15 ring-1 ring-white/20">
                        @if($user->profile_photo_url)
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full items-center justify-center text-3xl font-black text-white">
                                {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <p class="inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 backdrop-blur">
                            {{ __('Profile') }}
                        </p>
                        <h2 class="mt-3 text-3xl font-black leading-tight">
                            {{ $user->name }}
                        </h2>
                        <p class="mt-1 text-sm text-white/85">
                            {{ $user->email }}
                        </p>
                    </div>
                </div>

                <div>
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                        {{ __('Back to Dashboard') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-12">
            <div class="xl:col-span-4">
                <div class="rounded-[30px] border border-slate-200 bg-white p-6 shadow-xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">{{ __('User Information') }}</p>
                    <h3 class="mt-2 text-2xl font-bold text-[#243B73]">{{ __('Account Overview') }}</h3>

                    <div class="mt-6 space-y-4">
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Profile Photo') }}</p>
                            <div class="mt-3">
                                <div class="h-28 w-28 overflow-hidden rounded-full bg-slate-200 ring-4 ring-white shadow">
                                    @if($user->profile_photo_url)
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-3xl font-black text-[#243B73]">
                                            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Name') }}</p>
                            <p class="mt-2 text-base font-bold text-slate-800">{{ $user->name }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-500">{{ __('Email') }}</p>
                            <p class="mt-2 break-all text-base font-bold text-slate-800">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-8">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="rounded-[30px] border border-slate-200 bg-white p-6 shadow-xl">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">{{ __('Profile Settings') }}</p>
                        <h3 class="mt-2 text-2xl font-bold text-[#243B73]">{{ __('Update Account') }}</h3>
                        <p class="mt-2 text-sm text-slate-500">
                            {{ __('Update your account information and password from this page.') }}
                        </p>

                        <div class="mt-6 grid gap-5 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">{{ __('Profile Photo') }}</label>
                                <input
                                    type="file"
                                    name="photo"
                                    accept=".jpg,.jpeg,.png,.webp,image/*"
                                    class="mt-2 block w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm file:mr-4 file:rounded-xl file:border-0 file:bg-[#243B73] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white"
                                >
                                @error('photo')
                                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-slate-700">{{ __('Name') }}</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition focus:border-[#243B73] focus:ring-4 focus:ring-[#243B73]/10"
                                    required
                                >
                                @error('name')
                                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-slate-700">{{ __('Email') }}</label>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition focus:border-[#243B73] focus:ring-4 focus:ring-[#243B73]/10"
                                    required
                                >
                                @error('email')
                                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[30px] border border-slate-200 bg-white p-6 shadow-xl">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">{{ __('Security') }}</p>
                        <h3 class="mt-2 text-2xl font-bold text-[#243B73]">{{ __('Change Password') }}</h3>
                        <p class="mt-2 text-sm text-slate-500">
                            {{ __('Leave the password fields empty if you do not want to change the password.') }}
                        </p>

                        <div class="mt-6 grid gap-5 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label class="text-sm font-semibold text-slate-700">{{ __('Current Password') }}</label>
                                <input
                                    type="password"
                                    name="current_password"
                                    class="mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition focus:border-[#B61C66] focus:ring-4 focus:ring-[#B61C66]/10"
                                >
                                @error('current_password')
                                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-slate-700">{{ __('New Password') }}</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition focus:border-[#B61C66] focus:ring-4 focus:ring-[#B61C66]/10"
                                >
                                @error('password')
                                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-slate-700">{{ __('Confirm New Password') }}</label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition focus:border-[#B61C66] focus:ring-4 focus:ring-[#B61C66]/10"
                                >
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col gap-3 border-t border-slate-100 pt-6 md:flex-row">
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] px-6 py-3 text-sm font-bold text-white shadow-lg transition hover:-translate-y-0.5">
                                {{ __('Save Changes') }}
                            </button>

                            <a href="{{ route('dashboard') }}"
                               class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection