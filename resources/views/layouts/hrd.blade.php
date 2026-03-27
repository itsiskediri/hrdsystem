<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('HRD Surya Inspirasi Schools'))</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('sispng.ico') }}">
    <link rel="shortcut icon" href="{{ asset('sispng.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/sispng.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(182,28,102,0.08),_transparent_28%),radial-gradient(circle_at_top_right,_rgba(245,166,35,0.12),_transparent_30%),linear-gradient(to_bottom_right,#f8fafc,#ffffff,#f1f5f9)] text-slate-800">
    <div class="min-h-screen">
        <header class="sticky top-0 z-40 border-b border-white/20 bg-white/80 backdrop-blur-xl shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="mx-auto max-w-7xl px-4 py-4 md:px-6">
                <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-slate-200">
                            <img
                                src="{{ asset('images/sispng.png') }}"
                                alt="Surya Inspirasi Schools"
                                class="h-full w-full object-contain p-1"
                            >
                        </div>

                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#B61C66]">
                                {{ __('HRD System') }}
                            </p>
                            <h1 class="text-lg font-extrabold text-[#243B73] md:text-xl">
                                Surya Inspirasi Schools
                            </h1>
                            <p class="text-xs text-slate-500 md:text-sm">
                                {{ __('Sistem internal manajemen data pegawai') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 xl:items-end">
                        @auth
                            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:gap-4">
                                <nav class="flex flex-wrap items-center gap-2">
                                    <a href="{{ route('dashboard') }}"
                                       class="rounded-2xl px-4 py-2 text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-[#243B73]/10 text-[#243B73]' : 'text-slate-700 hover:bg-[#243B73]/10 hover:text-[#243B73]' }}">
                                        {{ __('Dashboard') }}
                                    </a>

                                    <a href="{{ route('employees.index') }}"
                                       class="rounded-2xl px-4 py-2 text-sm font-semibold transition {{ request()->routeIs('employees.*') ? 'bg-[#B61C66]/10 text-[#B61C66]' : 'text-slate-700 hover:bg-[#B61C66]/10 hover:text-[#B61C66]' }}">
                                        {{ __('Employees') }}
                                    </a>
                                </nav>

                                <div class="flex items-center gap-3">
                                    <details class="group relative">
                                        <summary class="flex cursor-pointer list-none items-center justify-center rounded-full bg-white p-1.5 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-50">
                                            <div class="h-11 w-11 overflow-hidden rounded-full bg-white shadow ring-1 ring-slate-200">
                                                @if(auth()->user()->profile_photo_url)
                                                    <img
                                                        src="{{ auth()->user()->profile_photo_url }}"
                                                        alt="{{ auth()->user()->name }}"
                                                        class="h-full w-full object-cover"
                                                    >
                                                @else
                                                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#243B73] to-[#B61C66] text-sm font-bold text-white">
                                                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </summary>

                                        <div class="absolute right-0 mt-3 w-72 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl">
                                            <div class="bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] p-4 text-white">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-12 w-12 overflow-hidden rounded-full bg-white/15 ring-1 ring-white/20">
                                                        @if(auth()->user()->profile_photo_url)
                                                            <img
                                                                src="{{ auth()->user()->profile_photo_url }}"
                                                                alt="{{ auth()->user()->name }}"
                                                                class="h-full w-full object-cover"
                                                            >
                                                        @else
                                                            <div class="flex h-full w-full items-center justify-center bg-white/15 text-base font-bold text-white">
                                                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="min-w-0">
                                                        <p class="truncate text-sm font-bold">
                                                            {{ auth()->user()->name ?? 'Admin' }}
                                                        </p>
                                                        <p class="truncate text-xs text-white/80">
                                                            {{ auth()->user()->email ?? 'admin@internal' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-2">
                                                <a href="{{ route('profile.index') }}"
                                                   class="flex items-center rounded-2xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('profile.*') ? 'bg-[#243B73]/10 text-[#243B73]' : 'text-slate-700 hover:bg-slate-50' }}">
                                                    {{ __('Profile') }}
                                                </a>

                                                <a href="{{ route('backup.index') }}"
                                                   class="mt-1 flex items-center rounded-2xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('backup.*') ? 'bg-[#B61C66]/10 text-[#B61C66]' : 'text-slate-700 hover:bg-slate-50' }}">
                                                    {{ __('Backup Data') }}
                                                </a>

                                                <details class="group/lang mt-1 rounded-2xl">
                                                    <summary class="flex cursor-pointer list-none items-center justify-between rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                                                        <span>{{ __('Language') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition group-open/lang:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                                        </svg>
                                                    </summary>

                                                    <div class="mt-1 space-y-1 px-2 pb-2">
                                                        <a href="{{ route('language.switch', 'id') }}"
                                                           class="flex items-center justify-between rounded-xl px-3 py-2 text-sm font-medium transition hover:bg-slate-50 {{ app()->getLocale() === 'id' ? 'bg-[#243B73]/10 text-[#243B73]' : 'text-slate-700' }}">
                                                            <span>Indonesia</span>
                                                            @if(app()->getLocale() === 'id')
                                                                <span class="text-xs font-bold">ID</span>
                                                            @endif
                                                        </a>

                                                        <a href="{{ route('language.switch', 'en') }}"
                                                           class="flex items-center justify-between rounded-xl px-3 py-2 text-sm font-medium transition hover:bg-slate-50 {{ app()->getLocale() === 'en' ? 'bg-[#B61C66]/10 text-[#B61C66]' : 'text-slate-700' }}">
                                                            <span>English</span>
                                                            @if(app()->getLocale() === 'en')
                                                                <span class="text-xs font-bold">EN</span>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </details>

                                                <div class="my-2 border-t border-slate-100"></div>

                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button
                                                        type="submit"
                                                        class="flex w-full items-center rounded-2xl px-4 py-3 text-sm font-semibold text-rose-600 transition hover:bg-rose-50">
                                                        {{ __('Logout') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </details>
                                </div>
                            </div>
                        @endauth

                        @guest
                            <div class="flex flex-wrap items-center gap-3">
                                <details class="group relative">
                                    <summary class="flex cursor-pointer list-none items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                        </svg>
                                    </summary>

                                    <div class="absolute right-0 mt-2 w-40 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-xl">
                                        <a href="{{ route('language.switch', 'id') }}"
                                           class="flex items-center justify-between rounded-xl px-3 py-2 text-sm font-medium transition hover:bg-slate-50 {{ app()->getLocale() === 'id' ? 'bg-[#243B73]/10 text-[#243B73]' : 'text-slate-700' }}">
                                            <span>Indonesia</span>
                                            @if(app()->getLocale() === 'id')
                                                <span class="text-xs font-bold">ID</span>
                                            @endif
                                        </a>

                                        <a href="{{ route('language.switch', 'en') }}"
                                           class="mt-1 flex items-center justify-between rounded-xl px-3 py-2 text-sm font-medium transition hover:bg-slate-50 {{ app()->getLocale() === 'en' ? 'bg-[#B61C66]/10 text-[#B61C66]' : 'text-slate-700' }}">
                                            <span>English</span>
                                            @if(app()->getLocale() === 'en')
                                                <span class="text-xs font-bold">EN</span>
                                            @endif
                                        </a>
                                    </div>
                                </details>

                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}"
                                       class="rounded-2xl bg-gradient-to-r from-[#243B73] to-[#B61C66] px-4 py-2 text-sm font-semibold text-white shadow-md transition hover:scale-[1.02]">
                                        {{ __('Login') }}
                                    </a>
                                @endif
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-6 md:px-6">
            @if(session('success'))
                <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 shadow-sm">
                    <p class="font-semibold">{{ __('Ada beberapa data yang perlu diperbaiki:') }}</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>