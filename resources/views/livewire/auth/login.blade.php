@extends('layouts.auth.login')

@section('title', __('Login'))

@section('content')
    <div class="mb-6 text-center lg:text-left">
        <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-slate-200 lg:mx-0">
            <img
                src="{{ asset('images/sispng.png') }}"
                alt="Surya Inspirasi Schools"
                class="h-full w-full object-contain p-2"
            >
        </div>

        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">{{ __('Login') }}</p>
        <h2 class="mt-2 text-3xl font-black text-[#243B73]">{{ __('Sign in to HRD System') }}</h2>
        <p class="mt-2 text-sm text-slate-500">
            {{ __('Please sign in using your email or username and password.') }}
        </p>
    </div>

    <div class="rounded-[30px] border border-slate-200 bg-white p-6 shadow-2xl shadow-slate-200/60">
        <form action="{{ route('login.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="login" class="text-sm font-semibold text-slate-700">
                    {{ __('Email or Username') }}
                </label>
                <input
                    id="login"
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    placeholder="{{ __('Enter email or username') }}"
                    class="mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-[#243B73] focus:ring-4 focus:ring-[#243B73]/10"
                    required
                    autofocus
                >
                @error('login')
                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="text-sm font-semibold text-slate-700">
                    {{ __('Password') }}
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="{{ __('Enter password') }}"
                    class="mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-[#B61C66] focus:ring-4 focus:ring-[#B61C66]/10"
                    required
                >
                @error('password')
                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] px-5 py-3 text-sm font-bold text-white shadow-lg transition hover:-translate-y-0.5"
            >
                {{ __('Sign In') }}
            </button>
        </form>
    </div>

    <p class="mt-5 text-center text-xs text-slate-400 lg:text-left">
        Surya Inspirasi Schools • {{ __('Internal HRD access') }}
    </p>
@endsection