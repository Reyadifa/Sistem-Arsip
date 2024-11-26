@extends('layouts.app')

@section('content')


    <div class="flex ">

        <!--include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-10  ">


            <form action="{{ route('arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf


                @method('PUT')

                {{-- Kotak Form --}}
                <main class="mx-10 mt-5 ">
                    <div
                        class="text-center text-2xl font-bold  sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600">
                        <span class="material-icons text-blue-500 text-4xl ">archive</span>
                        <h1>Edit Arsip</h1>
                    </div>
                    <hr class="border-2 border-gray-500 mb-10">
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
                    <main class=" grid grid-cols-2 gap-6 ">


                        {{-- Kategori --}}
                        <div class="">
                            <label for="id_kategori" class="block text-sm  font-semibold">Kategori</label>
                            <select name="id_kategori" id="id_kategori"
                                class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm "
                                required>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}"
                                        {{ $kategori->id_kategori == $arsip->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Nama Usaha --}}
                        <div>
                            <label for="nama_usaha" class="block text-sm  font-semibold">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" value="{{ $arsip->nama_usaha }}"
                                class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm"
                                required>
                        </div>
                        {{-- Alamat Usaha --}}
                        <div>
                            <label for="alamat_usaha" class="block text-sm  font-semibold">Alamat Usaha</label>
                            <input type="text" name="alamat_usaha" id="alamat_usaha" value="{{ $arsip->alamat_usaha }}"
                                class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm"
                                required>
                        </div>
                        {{-- Nama Pemilik --}}
                        <div>
                            <label for="nama_pemilik" class="block text-sm  font-semibold">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ $arsip->nama_pemilik }}"
                                class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm"
                                required>
                        </div>
                        {{-- Alamat Pemilik --}}
                        <div>
                            <label for="alamat_pemilik" class="block text-sm  font-semibold">Alamat
                                Pemilik</label>
                            <input type="text" name="alamat_pemilik" id="alamat_pemilik"
                                value="{{ $arsip->alamat_pemilik }}"
                                class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm"
                                required>
                        </div>
                        {{-- Npwp --}}
                        <div>
                            <label for="npwp" class="block text-sm  font-semibold">NPWP</label>
                            <input type="text" name="npwp" id="npwp" value="{{ $arsip->npwp }}"
                                class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm"
                                required>
                        </div>
                        {{-- Bulan --}}
                        <div>
                            <label for="bulan" class="block text-sm font-semibold">Bulan</label>
                            <select name="bulan" id="bulan"
                                class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm"
                                required>
                                <option value="Januari" {{ $arsip->bulan == 'Januari' ? 'selected' : '' }}>Januari
                                </option>
                                <option value="Februari" {{ $arsip->bulan == 'Februari' ? 'selected' : '' }}>Februari
                                </option>
                                <option value="Maret" {{ $arsip->bulan == 'Maret' ? 'selected' : '' }}>Maret</option>
                                <option value="April" {{ $arsip->bulan == 'April' ? 'selected' : '' }}>April</option>
                                <option value="Mei" {{ $arsip->bulan == 'Mei' ? 'selected' : '' }}>Mei</option>
                                <option value="Juni" {{ $arsip->bulan == 'Juni' ? 'selected' : '' }}>Juni</option>
                                <option value="Juli" {{ $arsip->bulan == 'Juli' ? 'selected' : '' }}>Juli</option>
                                <option value="Agustus" {{ $arsip->bulan == 'Agustus' ? 'selected' : '' }}>Agustus
                                </option>
                                <option value="September" {{ $arsip->bulan == 'September' ? 'selected' : '' }}>
                                    September
                                </option>
                                <option value="Oktober" {{ $arsip->bulan == 'Oktober' ? 'selected' : '' }}>Oktober
                                </option>
                                <option value="November" {{ $arsip->bulan == 'November' ? 'selected' : '' }}>November
                                </option>
                                <option value="Desember" {{ $arsip->bulan == 'Desember' ? 'selected' : '' }}>Desember
                                </option>
                            </select>
                        </div>
                        {{-- Tahun --}}
                        <div>
                            <label for="tahun" class="block text-sm  font-semibold">Tahun</label>
                            <input type="text" name="tahun" id="tahun" value="{{ $arsip->tahun }}"
                                class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm"
                                required>
                        </div>




                    </main>
                    {{-- File --}}
                    <div class="grid mt-5">
                        <label for="file" class="block text-sm  font-semibold">File</label>
                        <input type="file" name="file" id="file"
                            class="w-full rounded-lg border-black border-2 p-4 text-sm shadow-sm">
                    </div>
                    {{-- Simpan --}}
                    <div class="flex gap-4 ">
                        <button type="submit"
                            class=" px-6 py-3 text-white font-bold bg-green-500 rounded-lg hover:bg-green-600 mt-12 transform transition-transform duration-300 hover:scale-110">Simpan</button>
                        <a href="/arsip">
                            <button type="submit"
                                class=" px-6 py-3 text-white font-bold bg-blue-500 rounded-lg hover:bg-blue-600 mt-12 transform transition-transform duration-300 hover:scale-110">
                                Kembali</button>
                        </a>

                    </div>
                </main>



            </form>
        </div>

    </div>

@endsection
