<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen antialiased bg-gradient-to-br from-slate-100 via-white to-slate-100 dark:bg-gradient-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="flex min-h-svh items-center justify-center p-6 md:p-10">
        <div class="w-full max-w-md">
            <div class="rounded-[32px] border border-slate-200 bg-white/95 p-6 shadow-2xl shadow-slate-200/60 backdrop-blur dark:border-neutral-800 dark:bg-neutral-900/95 dark:shadow-black/30 md:p-8">
                <a href="{{ url('/') }}" class="mb-6 flex flex-col items-center gap-3 font-medium">
                    <span class="flex h-20 w-20 items-center justify-center overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-slate-200 dark:bg-neutral-900 dark:ring-neutral-700">
                        <img
                            src="{{ asset('images/sispng.png') }}"
                            alt="Surya Inspirasi Schools"
                            class="h-full w-full object-contain p-2"
                        >
                    </span>

                    <div class="text-center">
                        <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#B61C66]">
                            HRD System
                        </p>
                        <h1 class="mt-1 text-xl font-extrabold text-[#243B73] dark:text-white">
                            Surya Inspirasi Schools
                        </h1>
                        <p class="mt-1 text-sm text-slate-500 dark:text-neutral-400">
                            Sistem internal manajemen data pegawai
                        </p>
                    </div>
                </a>

                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    @fluxScripts
</body>
</html>