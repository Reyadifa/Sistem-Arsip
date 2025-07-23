@extends('layouts.app')

@section('content')
@include('layouts.sidebar')

<div>
    <div class="bg-blue-600 py-14">
        <div class="flex items-center">
            <i class="fas fa-book text-4xl text-white ml-6"></i>
            <h1 class="text-4xl font-bold ml-3 text-white">Edit Peminjaman</h1>
            <div class="absolute right-8 flex items-center gap-4">
                <h2 class="text-4xl font-bold text-white">
                    {{ Auth::user()->nama_user ?? 'User' }} |
                </h2>
                <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center">
                    <i class="fas fa-user text-4xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="m-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <strong class="font-bold">Ups!</strong>
            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <main class="p-10 bg-white max-w-6xl mx-auto rounded-xl space-y-6">

            <!-- Jenis Peminjaman -->
            <div class="bg-gray-50 p-6 rounded-lg border-2 border-gray-300 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 text-center">Pilih Jenis Peminjaman</h3>
                <div class="flex justify-center gap-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="form_type" value="with_surat" id="with_surat" class="mr-2"
                            {{ old('form_type', $peminjaman->surat_kuasa ? 'with_surat' : 'without_surat') == 'with_surat' ? 'checked' : '' }} onchange="toggleSuratKuasa()">
                        <span class="font-semibold text-blue-600">Dengan Surat Kuasa</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="form_type" value="without_surat" id="without_surat" class="mr-2"
                            {{ old('form_type', $peminjaman->surat_kuasa ? 'with_surat' : 'without_surat') == 'without_surat' ? 'checked' : '' }} onchange="toggleSuratKuasa()">
                        <span class="font-semibold text-green-600">Tanpa Surat Kuasa</span>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NPWP -->
                <div>
                    <label for="npwp" class="block font-bold mb-1">Pilih NPWP</label>
                    <select name="npwp" id="npwp" class="w-full p-3 rounded-lg border border-black" onchange="updateArsipDropdown()" required>
                        <option value="">-- Pilih NPWP --</option>
                        @foreach ($arsipsGrouped as $npwp => $arsipList)
                            <option value="{{ $npwp }}" {{ $npwp == old('npwp', $peminjaman->arsip->npwp) ? 'selected' : '' }}>
                                {{ $npwp }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Arsip -->
                <div>
                    <label for="arsip_id" class="block font-bold mb-1">Pilih Arsip</label>
                    <select name="arsip_id" id="arsip_id" class="w-full p-3 rounded-lg border border-black" required>
                        <option value="">-- Pilih Arsip --</option>
                    </select>
                </div>

                <!-- Tanggal Pinjam -->
                <div>
                    <label for="tgl_minjam" class="block font-bold mb-1">Tanggal Pinjam</label>
                    <input type="date" name="tgl_minjam" id="tgl_minjam" class="w-full p-3 rounded-lg border border-black"
                        value="{{ old('tgl_minjam', $peminjaman->tgl_minjam) }}" required>
                </div>

                <!-- Tanggal Kembali -->
                <div>
                    <label for="tgl_kembali" class="block font-bold mb-1">Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="w-full p-3 rounded-lg border border-black"
                        value="{{ old('tgl_kembali', $peminjaman->tgl_kembali) }}">
                </div>

                <!-- Nama Peminjam -->
                <div>
                    <label for="nama_peminjam" class="block font-bold mb-1">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" id="nama_peminjam" class="w-full p-3 rounded-lg border border-black"
                        value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block font-bold mb-1">Status</label>
                    <select name="status" id="status" class="w-full p-3 rounded-lg border border-black" required>
                        <option value="Dipinjam" {{ old('status', $peminjaman->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Dikembalikan" {{ old('status', $peminjaman->status) == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="Terlambat" {{ old('status', $peminjaman->status) == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>

                <!-- No HP -->
                <div>
                    <label for="nohp" class="block font-bold mb-1">Nomor HP</label>
                    <input type="text" name="nohp" id="nohp" class="w-full p-3 rounded-lg border border-black"
                        value="{{ old('nohp', $peminjaman->nohp) }}" required>
                </div>

                <!-- Surat Kuasa -->
                <div id="surat_kuasa_section">
                    <label for="surat_kuasa" class="block font-bold mb-1">Upload Surat Kuasa <span class="text-red-500">*</span></label>
                    <input type="file" name="surat_kuasa" id="surat_kuasa" class="w-full p-3 rounded-lg border border-black" accept=".jpg,.jpeg,.png,.pdf">
                    <small class="text-sm text-gray-500">Maks. 2MB, format: JPG, PNG, PDF.</small>
                    @if($peminjaman->surat_kuasa)
                        <div class="mt-2">
                            <small class="text-blue-600">File saat ini:
                                <a href="{{ asset('storage/' . $peminjaman->surat_kuasa) }}" target="_blank" class="underline">
                                    {{ basename($peminjaman->surat_kuasa) }}
                                </a>
                            </small>
                            <label class="flex items-center mt-2">
                                <input type="checkbox" name="hapus_surat_kuasa" id="hapus_surat_kuasa" class="mr-2" onchange="toggleHapusSurat()">
                                <span class="text-sm text-red-600 font-semibold">Hapus surat kuasa yang ada</span>
                            </label>
                        </div>
                    @endif
                </div>

                <!-- Keperluan -->
                <div class="col-span-2">
                    <label for="keperluan" class="block font-bold mb-1">Keperluan</label>
                    <textarea name="keperluan" id="keperluan" class="w-full p-3 rounded-lg border border-black" rows="3" required>{{ old('keperluan', $peminjaman->keperluan) }}</textarea>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-center gap-6 mt-10">
                <button type="submit" class="bg-green-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-600">Simpan</button>
                <a href="{{ route('peminjaman.index') }}" class="bg-gray-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-600">Kembali</a>
            </div>
        </main>
    </form>
</div>

<script>
    const arsipsGrouped = @json($arsipsGrouped);
    const selectedNpwp = "{{ old('npwp', $peminjaman->arsip->npwp) }}";
    const selectedArsipId = "{{ old('arsip_id', $peminjaman->arsip_id) }}";

    function toggleSuratKuasa() {
        const withSurat = document.getElementById('with_surat').checked;
        const suratKuasaSection = document.getElementById('surat_kuasa_section');
        const suratKuasaInput = document.getElementById('surat_kuasa');

        if (withSurat) {
            suratKuasaSection.style.display = 'block';
            suratKuasaInput.setAttribute('required', 'required');
        } else {
            suratKuasaSection.style.display = 'none';
            suratKuasaInput.removeAttribute('required');
            suratKuasaInput.value = '';
            const hapusCheckbox = document.getElementById('hapus_surat_kuasa');
            if (hapusCheckbox) hapusCheckbox.checked = false;
        }
    }

    function toggleHapusSurat() {
        const hapusCheckbox = document.getElementById('hapus_surat_kuasa');
        const suratKuasaInput = document.getElementById('surat_kuasa');
        if (hapusCheckbox.checked) {
            suratKuasaInput.removeAttribute('required');
            suratKuasaInput.value = '';
        } else {
            const withSurat = document.getElementById('with_surat').checked;
            if (withSurat) suratKuasaInput.setAttribute('required', 'required');
        }
    }

    function updateArsipDropdown() {
        const npwp = document.getElementById('npwp').value;
        const arsipDropdown = document.getElementById('arsip_id');

        arsipDropdown.innerHTML = '<option value="">-- Pilih Arsip --</option>';

        if (npwp && arsipsGrouped[npwp]) {
            arsipsGrouped[npwp].forEach(arsip => {
                const option = document.createElement('option');
                option.value = arsip.id;
                option.textContent = `${arsip.kategori.nama_kategori} - ${arsip.bulan}/${arsip.tahun}`;
                
                // Auto select berdasarkan old value atau data existing
                if (arsip.id == selectedArsipId) {
                    option.selected = true;
                }
                arsipDropdown.appendChild(option);
            });
            arsipDropdown.disabled = false;
        } else {
            arsipDropdown.disabled = true;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        toggleSuratKuasa();
        
        // Set NPWP value otomatis berdasarkan old atau existing data
        const npwpDropdown = document.getElementById('npwp');
        if (selectedNpwp) {
            npwpDropdown.value = selectedNpwp;
            // Trigger updateArsipDropdown setelah NPWP di-set
            updateArsipDropdown();
        }
    });
</script>

@endsection