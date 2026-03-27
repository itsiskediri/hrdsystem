<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('Login').' - Surya Inspirasi Schools')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('sispng.ico') }}">
    <link rel="shortcut icon" href="{{ asset('sispng.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/sispng.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-100 via-white to-slate-100">
    <div class="grid min-h-screen lg:grid-cols-2">
        <div class="relative hidden overflow-hidden bg-gradient-to-br from-[#243B73] via-[#2f4b8f] to-[#B61C66] lg:block">
            <div class="absolute -left-10 top-10 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-56 w-56 rounded-full bg-[#F5A623]/20 blur-3xl"></div>

            <div class="relative flex h-full flex-col justify-between p-12 text-white">
                <div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-white/95 shadow-xl">
                            <img
                                src="{{ asset('images/sispng.png') }}"
                                alt="Surya Inspirasi Schools"
                                class="h-full w-full object-contain p-2"
                            >
                        </div>

                        <p class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-semibold tracking-[0.2em] backdrop-blur">
                            {{ __('HRD System') }}
                        </p>
                    </div>

                    <h1 class="mt-8 text-5xl font-black leading-tight">
                        Surya Inspirasi Schools
                    </h1>

                    <p class="mt-5 max-w-xl text-base leading-7 text-white/85">
                        {{ __('Internal HRD system to manage employee data, work contracts, personal documents, and personnel administration in a modern way.') }}
                    </p>
                </div>

                <div class="text-sm text-white/75">
                    {{ __('Access is restricted to admin / HRD users with authorized accounts.') }}
                </div>
            </div>
        </div>

        <div class="relative flex items-center justify-center px-4 py-10 sm:px-6 lg:px-10">
            <div class="absolute right-4 top-4 sm:right-6 sm:top-6">
                <div class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-white/90 p-1 shadow-sm backdrop-blur">
                    <a href="{{ route('language.switch', 'id') }}"
                       class="rounded-xl px-3 py-2 text-sm font-semibold transition {{ app()->getLocale() === 'id' ? 'bg-[#243B73] text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                        ID
                    </a>

                    <a href="{{ route('language.switch', 'en') }}"
                       class="rounded-xl px-3 py-2 text-sm font-semibold transition {{ app()->getLocale() === 'en' ? 'bg-[#B61C66] text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                        EN
                    </a>
                </div>
            </div>

            <div class="w-full max-w-md">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>