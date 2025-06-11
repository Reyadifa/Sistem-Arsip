@extends('layouts.app')

@section('content')
@include('layouts.sidebar')
<div class="">
    <div class="bg-blue-600 py-14">
        <div class="flex items-center">
            <span class="material-icons text-4xl text-white"></span>
            <div class="absolute right-8 flex items-center gap-4">
                <h2 class="text-4xl font-bold ml-3 text-white ">
                    {{ Auth::user()->nama_user ?? 'User' }} |
                </h2>
                <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center"><i class="fas fa-user text-4xl text-white "></i></div>
            </div>
        </div>
    </div>

    {{-- Pesan Kesalahan --}}
    @if ($errors->any())
        <div class="mb-4">
            <div class="bg-red-200 border border-red-600 text-red-600 p-3 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <main class="p-10 bg-white max-1xl rounded-xl space-y-6 mx-2">
            <div class="text-center text-2xl font-bold sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                <i class="fas fa-book text-4xl text-blue-600 "></i>
                <h1>Edit Peminjaman</h1>
            </div>

            <hr class="border-2 border-black w-[600px] mx-auto">

            <!-- Pilihan Jenis Form -->
            <div class="bg-gray-50 p-6 rounded-lg border-2 border-gray-300 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 text-center">Pilih Jenis Peminjaman</h3>
                <div class="flex justify-center gap-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="form_type" value="with_surat" id="with_surat" class="mr-3 w-4 h-4" 
                               {{ $peminjaman->surat_kuasa ? 'checked' : '' }} onchange="toggleSuratKuasa()">
                        <span class="text-md font-semibold text-blue-600">
                            <i class="fas fa-file-contract mr-2"></i>Dengan Surat Kuasa
                        </span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="form_type" value="without_surat" id="without_surat" class="mr-3 w-4 h-4" 
                               {{ !$peminjaman->surat_kuasa ? 'checked' : '' }} onchange="toggleSuratKuasa()">
                        <span class="text-md font-semibold text-green-600">
                            <i class="fas fa-file-alt mr-2"></i>Tanpa Surat Kuasa
                        </span>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">

                <!-- Dropdown untuk memilih NPWP dan Nama Usaha -->
                <div>
                    <label for="npwp" class="block font-bold text-black mb-1">Pilih NPWP dan Nama Usaha</label>
                    <select name="npwp" id="npwp" class="w-full p-3 rounded-lg border-black border" onchange="updateArsipDropdown()" required>
                        <option value="">Pilih NPWP dan Nama Usaha</option>
                        @foreach ($arsipsGrouped as $key => $arsips)
                            @php
                                $firstArsip = $arsips[0];
                            @endphp
                            <option value="{{ $firstArsip->npwp }}"
                                {{ $firstArsip->npwp == old('npwp', $peminjaman->arsip->npwp) ? 'selected' : '' }}>
                                {{ $firstArsip->npwp }} - {{ $firstArsip->nama_usaha }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown Arsip -->
                <div>
                    <label for="arsip_id" class="block font-bold text-black mb-1">Pilih Arsip</label>
                    <select name="arsip_id" id="arsip_id" class="w-full p-3 rounded-lg border-black border" onchange="updateFileInfo()" required disabled>
                        <option value="">Pilih Arsip</option>
                    </select>
                </div>

                <!-- Input Tanggal Pinjam -->
                <div>
                    <label for="tgl_minjam" class="block font-bold text-black mb-1">Tanggal Pinjam</label>
                    <input type="date" class="w-full p-3 rounded-lg border-black border" id="tgl_minjam"
                        name="tgl_minjam" placeholder="Pilih Tanggal Pinjam" 
                        value="{{ old('tgl_minjam', $peminjaman->tgl_minjam) }}" required>
                </div>

                <!-- Input Tanggal Kembali -->
                <div>
                    <label for="tgl_kembali" class="block font-bold text-black mb-1">Tanggal Kembali</label>
                    <input type="date" class="w-full p-3 rounded-lg border-black border" id="tgl_kembali"
                        name="tgl_kembali" placeholder="Pilih Tanggal Kembali" 
                        value="{{ old('tgl_kembali', $peminjaman->tgl_kembali) }}" required>
                </div>

                <!-- Input Nama Peminjam -->
                <div>
                    <label for="nama_peminjam" class="block font-bold text-black mb-1">Nama Peminjam</label>
                    <input type="text" class="w-full p-3 rounded-lg border-black border" id="nama_peminjam"
                        name="nama_peminjam" placeholder="Masukkan Nama Peminjam" 
                        value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required>
                </div>

                <!-- Dropdown Status -->
                <div>
                    <label for="status" class="block font-bold text-black mb-1">Status</label>
                    <select name="status" id="status" class="w-full p-3 rounded-lg border-black border" required>
                        <option value="Dipinjam" {{ old('status', $peminjaman->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Dikembalikan" {{ old('status', $peminjaman->status) == 'Dikembalikan' ? 'selected' : '' }}>
                            Dikembalikan</option>
                        <option value="Terlambat" {{ old('status', $peminjaman->status) == 'Terlambat' ? 'selected' : '' }}>Terlambat
                        </option>
                    </select>
                </div>

                <!-- Input Nomor HP -->
                <div>
                    <label for="nohp" class="block font-bold text-black mb-1">Nomor HP</label>
                    <input type="text" name="nohp" id="nohp" 
                        value="{{ old('nohp', $peminjaman->nohp) }}"
                        class="w-full p-3 rounded-lg border border-black" required>
                </div>

                <!-- Upload Surat Kuasa - Kondisional -->
                <div id="surat_kuasa_section">
                    <label for="surat_kuasa" class="block font-bold text-black mb-1">Upload Surat Kuasa
                        <span class="text-red-500">*</span></label>
                    <input type="file" name="surat_kuasa" id="surat_kuasa" accept=".jpg,.jpeg,.png,.pdf"
                        class="w-full p-3 rounded-lg border border-black">
                    <small class="text-sm text-gray-500">Format: JPG, PNG, atau PDF. Maks. 2MB.</small>
                    @if($peminjaman->surat_kuasa)
                        <div class="mt-2" id="existing_file">
                            <small class="text-sm text-blue-600">
                                File saat ini: 
                                <a href="{{ asset('storage/' . $peminjaman->surat_kuasa) }}" target="_blank" class="underline">
                                    {{ basename($peminjaman->surat_kuasa) }}
                                </a>
                            </small>
                            <div class="mt-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="hapus_surat_kuasa" id="hapus_surat_kuasa" class="mr-2" onchange="toggleHapusSurat()">
                                    <span class="text-sm text-red-600 font-semibold">
                                        <i class="fas fa-trash mr-1"></i>Hapus surat kuasa yang ada
                                    </span>
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Textarea Keperluan -->
                <div class="col-span-2">
                    <label for="keperluan" class="block font-bold text-black mb-1">Keperluan</label>
                    <textarea class="w-full px-3 pt-3 rounded-lg border-black border" id="keperluan" name="keperluan" rows="3"
                        placeholder="Jelaskan keperluan Anda" required>{{ old('keperluan', $peminjaman->keperluan) }}</textarea>
                </div>

            </div>

            <!-- Tombol Simpan -->
            <div class="text-center flex gap-5">
                <button type="submit"
                    class="bg-green-500 px-8 py-3 rounded-lg text-white text-xl hover:bg-green-600 font-bold transform transition-transform duration-300 hover:scale-110">
                    Simpan
                </button>
                <a href="{{ route('peminjaman.index') }}"
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-300 hover:scale-110">Kembali</a>
            </div>
        </main>
    </form>
</div>

<script>
    const arsipsGrouped = @json($arsipsGrouped);

    // Function untuk toggle surat kuasa section
    function toggleSuratKuasa() {
        const withSurat = document.getElementById('with_surat').checked;
        const suratKuasaSection = document.getElementById('surat_kuasa_section');
        const suratKuasaInput = document.getElementById('surat_kuasa');
        
        if (withSurat) {
            suratKuasaSection.style.display = 'block';
            suratKuasaSection.querySelector('label span').style.display = 'inline'; // Show required asterisk
            suratKuasaInput.setAttribute('required', 'required');
        } else {
            suratKuasaSection.style.display = 'none';
            suratKuasaInput.removeAttribute('required');
            suratKuasaInput.value = ''; // Clear file input
            // Clear hapus checkbox jika ada
            const hapusCheckbox = document.getElementById('hapus_surat_kuasa');
            if (hapusCheckbox) {
                hapusCheckbox.checked = false;
            }
        }
    }

    // Function untuk toggle hapus surat kuasa
    function toggleHapusSurat() {
        const hapusCheckbox = document.getElementById('hapus_surat_kuasa');
        const suratKuasaInput = document.getElementById('surat_kuasa');
        
        if (hapusCheckbox.checked) {
            suratKuasaInput.removeAttribute('required');
            suratKuasaInput.value = ''; // Clear file input
        } else {
            const withSurat = document.getElementById('with_surat').checked;
            if (withSurat) {
                suratKuasaInput.setAttribute('required', 'required');
            }
        }
    }

    function updateArsipDropdown() {
        const npwpSelect = document.getElementById('npwp');
        const arsipSelect = document.getElementById('arsip_id');
        const selectedNpwp = npwpSelect.value;

        arsipSelect.innerHTML = '<option value="">-- Pilih Arsip --</option>'; // reset

        if (selectedNpwp && arsipsGrouped[selectedNpwp]) {
            arsipSelect.disabled = false;

            arsipsGrouped[selectedNpwp].forEach(arsip => {
                let option = document.createElement('option');
                option.value = arsip.id;
                option.textContent = 
                    `${arsip.nama_usaha} - Kategori: ${arsip.kategori.nama_kategori}, Bulan: ${arsip.bulan}, Tahun: ${arsip.tahun}`;
                
                // Set selected jika sesuai dengan arsip_id peminjaman
                if (arsip.id == {{ $peminjaman->arsip_id }}) {
                    option.selected = true;
                }
                arsipSelect.appendChild(option);
            });
        } else {
            arsipSelect.disabled = true;
        }
    }

    // On page load, set dropdown arsip sesuai npwp lama
    document.addEventListener('DOMContentLoaded', () => {
        const npwpSelect = document.getElementById('npwp');
        if (npwpSelect.value) {
            updateArsipDropdown();
        }
        
        // Initialize surat kuasa visibility
        toggleSuratKuasa();
    });
</script>

@endsection