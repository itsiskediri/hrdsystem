@php
    $inputClass = 'mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-[#243B73] focus:ring-4 focus:ring-[#243B73]/10';
    $selectClass = 'mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition focus:border-[#B61C66] focus:ring-4 focus:ring-[#B61C66]/10';
    $textareaClass = 'mt-2 w-full rounded-2xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-[#243B73] focus:ring-4 focus:ring-[#243B73]/10';

    $dateValue = function ($field) use ($employee) {
        $value = old($field, $employee->{$field} ?? null);

        if ($value instanceof \Carbon\CarbonInterface) {
            return $value->format('Y-m-d');
        }

        return $value ?: '';
    };

    $excelFields = [
        ['name' => 'institution', 'label' => 'Lembaga', 'type' => 'text', 'placeholder' => 'Contoh: TK / SD / SMP / SMA'],
        ['name' => 'position', 'label' => 'Profesi', 'type' => 'text', 'placeholder' => 'Contoh: Guru / Kepala Sekolah'],
        ['name' => 'employee_number', 'label' => 'No. Karyawan', 'type' => 'text', 'placeholder' => 'Contoh: SIS-0001'],
        ['name' => 'name', 'label' => 'Nama', 'type' => 'text', 'placeholder' => 'Masukkan nama lengkap', 'required' => true],
        ['name' => 'birth_place', 'label' => 'Tempat Lahir', 'type' => 'text', 'placeholder' => 'Contoh: Jakarta'],
        ['name' => 'religion', 'label' => 'Agama', 'type' => 'text', 'placeholder' => 'Contoh: Islam'],
        ['name' => 'postal_code', 'label' => 'Kode Pos', 'type' => 'text', 'placeholder' => 'Contoh: 64111'],
        ['name' => 'ktp_number', 'label' => 'No. KTP', 'type' => 'text', 'placeholder' => 'Masukkan nomor KTP'],
        ['name' => 'kk_number', 'label' => 'No. Kartu Keluarga', 'type' => 'text', 'placeholder' => 'Masukkan nomor KK'],
        ['name' => 'contract_number', 'label' => 'No. Kontrak', 'type' => 'text', 'placeholder' => 'Masukkan nomor kontrak'],
        ['name' => 'education', 'label' => 'Pendidikan', 'type' => 'text', 'placeholder' => 'Contoh: S1'],
        ['name' => 'level', 'label' => 'Jenjang', 'type' => 'text', 'placeholder' => 'Contoh: Sarjana'],
        ['name' => 'major', 'label' => 'Jurusan', 'type' => 'text', 'placeholder' => 'Contoh: Pendidikan Matematika'],
        ['name' => 'phone', 'label' => 'No. HP', 'type' => 'tel', 'placeholder' => '08xxxxxxxxxx'],
        ['name' => 'npwp', 'label' => 'NPWP', 'type' => 'text', 'placeholder' => 'Masukkan nomor NPWP'],
        ['name' => 'bpjs_health', 'label' => 'BPJS Kesehatan', 'type' => 'text', 'placeholder' => 'Nomor BPJS Kesehatan'],
        ['name' => 'bpjs_employment', 'label' => 'BPJS Ketenagakerjaan', 'type' => 'text', 'placeholder' => 'Nomor BPJS Ketenagakerjaan'],
        ['name' => 'bank_name', 'label' => 'Bank', 'type' => 'text', 'placeholder' => 'Contoh: BCA'],
        ['name' => 'bank_account_number', 'label' => 'Nomor Rekening', 'type' => 'text', 'placeholder' => 'Masukkan nomor rekening'],
        ['name' => 'mother_name', 'label' => 'Nama Ibu Kandung', 'type' => 'text', 'placeholder' => 'Masukkan nama ibu kandung'],
        ['name' => 'email', 'label' => 'Alamat Email', 'type' => 'email', 'placeholder' => 'nama@email.com'],
        ['name' => 'work_email', 'label' => 'Email Inspirasi', 'type' => 'email', 'placeholder' => 'nama@inspirasischools.org'],
        ['name' => 'tax_status', 'label' => 'Status Pajak', 'type' => 'text', 'placeholder' => 'Contoh: TK/0 atau K/1'],
    ];
@endphp

<div class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
    <div class="border-b border-slate-100 bg-gradient-to-r from-white via-slate-50 to-white px-5 py-5 md:px-7">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">Form HRD</p>
                <h2 class="mt-1 text-2xl font-bold text-[#243B73]">Data Pegawai</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Form ini sudah disesuaikan mengikuti struktur data Excel pegawai.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <span class="h-3 w-3 rounded-full bg-[#B61C66]"></span>
                <span class="h-3 w-3 rounded-full bg-[#F5A623]"></span>
                <span class="h-3 w-3 rounded-full bg-[#243B73]"></span>
            </div>
        </div>
    </div>

    <div class="p-5 md:p-7">
        <div class="mb-6 rounded-3xl bg-gradient-to-r from-[#243B73]/8 via-[#B61C66]/8 to-[#F5A623]/12 p-4">
            <p class="text-sm font-semibold text-slate-700">
                Field dengan tanda <span class="font-bold text-rose-500">*</span> wajib diisi.
            </p>
        </div>

        <div class="mb-8">
            <div class="mb-4">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">Format Excel</p>
                <h3 class="mt-1 text-xl font-bold text-[#243B73]">Data Utama Pegawai</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                @foreach($excelFields as $field)
                    <div>
                        <label class="text-sm font-semibold text-slate-700">
                            {{ $field['label'] }}
                            @if(!empty($field['required']))
                                <span class="text-rose-500">*</span>
                            @endif
                        </label>

                        <input
                            type="{{ $field['type'] ?? 'text' }}"
                            name="{{ $field['name'] }}"
                            value="{{ old($field['name'], $employee->{$field['name']} ?? '') }}"
                            placeholder="{{ $field['placeholder'] ?? '' }}"
                            @if(!empty($field['required'])) required @endif
                            class="{{ $inputClass }}"
                        >

                        @error($field['name'])
                            <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach

                <div>
                    <label class="text-sm font-semibold text-slate-700">Jenis Kelamin</label>
                    <select name="gender" class="{{ $selectClass }}">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="L" {{ old('gender', $employee->gender ?? '') === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="P" {{ old('gender', $employee->gender ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">Tanggal Lahir</label>
                    <input
                        type="date"
                        name="birth_date"
                        value="{{ $dateValue('birth_date') }}"
                        class="{{ $inputClass }}"
                    >
                    @error('birth_date')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">Tgl. Awal Kontrak</label>
                    <input
                        type="date"
                        name="contract_start_date"
                        value="{{ $dateValue('contract_start_date') }}"
                        class="{{ $inputClass }}"
                    >
                    @error('contract_start_date')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">Tgl. Akhir Kontrak</label>
                    <input
                        type="date"
                        name="contract_end_date"
                        value="{{ $dateValue('contract_end_date') }}"
                        class="{{ $inputClass }}"
                    >
                    @error('contract_end_date')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700">Alamat</label>
                    <textarea
                        name="address"
                        rows="4"
                        placeholder="Masukkan alamat lengkap pegawai"
                        class="{{ $textareaClass }}"
                    >{{ old('address', $employee->address ?? '') }}</textarea>
                    @error('address')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700">Keterangan</label>
                    <textarea
                        name="notes"
                        rows="4"
                        placeholder="Tambahkan keterangan jika diperlukan"
                        class="{{ $textareaClass }}"
                    >{{ old('notes', $employee->notes ?? '') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-8">
            <div class="mb-4">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B61C66]">Tambahan Sistem</p>
                <h3 class="mt-1 text-xl font-bold text-[#243B73]">Field HRD Internal</h3>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700">Status Pernikahan</label>
                    <select name="marital_status" class="{{ $selectClass }}">
                        <option value="">Pilih status pernikahan</option>
                        <option value="belum_kawin" {{ old('marital_status', $employee->marital_status ?? '') === 'belum_kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="kawin" {{ old('marital_status', $employee->marital_status ?? '') === 'kawin' ? 'selected' : '' }}>Kawin</option>
                    </select>
                    @error('marital_status')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">NPWP sudah terintegrasi KTP?</label>
                    <select name="npwp_integrated_with_ktp" class="{{ $selectClass }}">
                        <option value="0" {{ (string) old('npwp_integrated_with_ktp', $employee->npwp_integrated_with_ktp ?? 0) === '0' ? 'selected' : '' }}>Belum</option>
                        <option value="1" {{ (string) old('npwp_integrated_with_ktp', $employee->npwp_integrated_with_ktp ?? 0) === '1' ? 'selected' : '' }}>Sudah</option>
                    </select>
                    @error('npwp_integrated_with_ktp')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">Status Pegawai</label>
                    <input
                        type="text"
                        name="employment_status"
                        value="{{ old('employment_status', $employee->employment_status ?? '') }}"
                        placeholder="Contoh: Kontrak / Tetap"
                        class="{{ $inputClass }}"
                    >
                    @error('employment_status')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">Reminder Kontrak (hari)</label>
                    <input
                        type="number"
                        name="contract_reminder_days"
                        min="1"
                        max="365"
                        value="{{ old('contract_reminder_days', $employee->contract_reminder_days ?? 30) }}"
                        placeholder="Contoh: 30"
                        class="{{ $inputClass }}"
                    >
                    @error('contract_reminder_days')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">Tanggal Permanent</label>
                    <input
                        type="date"
                        name="permanent_date"
                        value="{{ $dateValue('permanent_date') }}"
                        class="{{ $inputClass }}"
                    >
                    @error('permanent_date')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div class="rounded-3xl border-2 border-dashed border-[#243B73]/20 bg-[#243B73]/5 p-5">
                <label class="text-sm font-semibold text-slate-700">Foto Pegawai</label>
                <input
                    type="file"
                    name="photo"
                    accept=".jpg,.jpeg,.png,.webp,image/*"
                    class="mt-3 block w-full rounded-2xl border-2 border-white bg-white px-4 py-3 text-sm text-slate-700 shadow-sm file:mr-4 file:rounded-xl file:border-0 file:bg-[#243B73] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white"
                >
                @error('photo')
                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                @enderror

                @if(!empty($employee->photo_url))
                    <div class="mt-4">
                        <img
                            src="{{ $employee->photo_url }}"
                            alt="Foto Pegawai"
                            class="h-28 w-28 rounded-3xl border-4 border-white object-cover shadow-lg"
                        >
                    </div>
                @endif
            </div>

            <div class="rounded-3xl border-2 border-dashed border-[#B61C66]/20 bg-[#B61C66]/5 p-5">
                <label class="text-sm font-semibold text-slate-700">Upload Data Pribadi (PDF compile)</label>
                <input
                    type="file"
                    name="personal_document"
                    accept=".pdf,application/pdf"
                    class="mt-3 block w-full rounded-2xl border-2 border-white bg-white px-4 py-3 text-sm text-slate-700 shadow-sm file:mr-4 file:rounded-xl file:border-0 file:bg-[#B61C66] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white"
                >
                @error('personal_document')
                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                @enderror

                @if(!empty($employee->personal_document_path))
                    <a
                        href="{{ route('employees.document', $employee) }}"
                        class="mt-4 inline-flex rounded-2xl bg-[#B61C66] px-4 py-3 text-sm font-semibold text-white shadow hover:bg-[#991853]">
                        Lihat / Download PDF
                    </a>
                @endif
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-3 border-t border-slate-100 pt-6 md:flex-row">
            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#243B73] via-[#2f4b8f] to-[#B61C66] px-6 py-3 text-sm font-bold text-white shadow-lg transition hover:-translate-y-0.5">
                Simpan Data Pegawai
            </button>

            <a
                href="{{ route('employees.index') }}"
                class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Batal
            </a>
        </div>
    </div>
</div>