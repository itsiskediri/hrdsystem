@extends('layouts.hrd')

@section('title', __('Add Employee'))

@section('content')
    <div class="space-y-6">
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] p-6 text-white shadow-2xl">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-[#F5A623]/20 blur-3xl"></div>
            <div class="absolute -bottom-10 left-0 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-2xl">
                    <p class="inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 backdrop-blur">
                        Surya Inspirasi Schools
                    </p>

                    <h2 class="mt-4 text-3xl font-black leading-tight md:text-4xl">
                        {{ __('Add Employee') }}
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-white/90 md:text-base">
                        Tambahkan data pegawai sesuai format Excel, mulai dari identitas utama, kontrak kerja,
                        kontak, hingga informasi administrasi pendukung.
                    </p>
                </div>

                <div>
                    <a href="{{ route('employees.index') }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                        ← {{ __('Back to Employees') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-12">
            <div class="xl:col-span-8">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('employees._form')
                </form>
            </div>

            <div class="xl:col-span-4">
                <div class="rounded-[30px] border border-slate-200 bg-white p-5 shadow-xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">{{ __('Instructions') }}</p>
                    <h3 class="mt-2 text-xl font-bold text-[#243B73]">Panduan Input Excel</h3>

                    <div class="mt-5 space-y-4 text-sm text-slate-600">
                        <div class="rounded-2xl bg-[#243B73]/5 p-4">
                            <p class="font-bold text-[#243B73]">Data Utama</p>
                            <p class="mt-1">
                                Isi lembaga, profesi, no. karyawan, nama, jenis kelamin, tempat lahir, dan tanggal lahir sesuai data Excel.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-[#B61C66]/5 p-4">
                            <p class="font-bold text-[#B61C66]">Identitas & Kontak</p>
                            <p class="mt-1">
                                Pastikan KTP, KK, email pribadi, email inspirasi, nomor HP, dan alamat diisi dengan benar.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-[#F5A623]/10 p-4">
                            <p class="font-bold text-[#9a6300]">Kontrak & Administrasi</p>
                            <p class="mt-1">
                                Lengkapi no. kontrak, tanggal kontrak, status pajak, BPJS, bank, dan reminder kontrak agar monitoring lebih akurat.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="font-bold text-slate-800">Dokumen Pendukung</p>
                            <p class="mt-1">
                                Upload foto pegawai dan dokumen PDF pribadi agar arsip digital pegawai tetap rapi dan lengkap.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection