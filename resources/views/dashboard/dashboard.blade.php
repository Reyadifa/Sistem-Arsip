@extends('layouts.app')

@section('content')
    <div class="flex"> <!-- Kontainer utama dengan tinggi penuh -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')

        <div class="flex-1 bg-gray-200">

            <div class="bg-blue-600 py-10">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white">dashboard</span>
                    <h1 class="text-4xl font-bold ml-3 text-white">
                        Dashboard
                    </h1>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-gray-500 rounded-full h-14 w-14 overflow-hidden flex justify-center items-center">
                            <i class="fas fa-user text-4xl text-white"></i>
                        </div>
                    </div>                    
                </div>
            </div>
            {{-- konten --}}

            <div class="p-14">

                <div class="flex gap-32 mb-8 ">
                    {{-- User --}}
                    <div class="bg-white p-4 rounded-3xl flex items-center gap-14 justify-center w-1/3 py-12 font-bold relative overflow-hidden">
                        <div class="bg-green-500 w-6 h-full absolute left-0"></div>
                        <div class="text-3xl">
                            <p>User</p>
                            <p class="text-center mt-2">{{ $userCount }}</p>
                        </div>
                        <div>
                            <i class="fas fa-user text-green-500 text-6xl"></i>
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="bg-white p-4 rounded-3xl flex items-center gap-14 justify-center w-1/3 py-12 font-bold relative overflow-hidden">
                        <div class="bg-blue-500 w-6 h-full absolute left-0"></div>
                        <div class="text-3xl">
                            <p>Kategori</p>
                            <p class="text-center mt-2">{{ $kategoriCount }}</p>
                        </div>
                        <div>
                            <i class="fas fa-tags text-blue-500 text-5xl"></i>
                        </div>
                    </div>

                    {{-- Arsip --}}
                    <div class="bg-white p-4 rounded-3xl flex items-center gap-14 justify-center w-1/3 py-12 font-bold relative overflow-hidden">
                        <div class="bg-yellow-500 w-6 h-full absolute left-0"></div>
                        <div class="text-3xl">
                            <p>Arsip</p>
                            <p class="text-center mt-2">{{ $arsipCount }}</p>
                        </div>
                        <div>
                            <i class="fas fa-download text-yellow-500 text-5xl"></i>
                        </div>
                    </div>
                </div>

                {{-- Charts --}}
                <div class="bg-white p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">
                            Arsip Masuk Bulanan
                        </h2>
                        <div class="flex space-x-2">
                            <select class="p-2 border rounded" id="yearSelect" onchange="updateYear()">
                                @foreach ($years as $item)
                                    <option value="{{ $item->tahun }}" @if ($item->tahun == $year) selected @endif>
                                        {{ $item->tahun }}
                                    </option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>
                    <canvas height="200" id="myChart" width="600"></canvas>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myChart').getContext('2d');

            // Membuat gradasi warna untuk garis
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(0, 123, 255, 1)'); // Warna biru muda
            gradient.addColorStop(1, 'rgba(0, 0, 123, 1)'); // Warna biru tua

            // Label untuk bulan
            const labels = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            // Data yang dikirim dari controller
            const data = @json($data); // Mengambil data arsip per bulan yang sudah diproses dari controller

            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels, // Label bulan
                    datasets: [{
                        label: '', // Kosongkan label
                        data: Object.values(data), // Data arsip per bulan
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: gradient, // Menggunakan gradasi untuk garis
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(0, 123, 255, 1)', // Warna titik biru muda
                        pointBorderColor: 'rgba(0, 123, 255, 1)', // Warna border titik biru muda
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        fill: true // Mengaktifkan area berwarna di bawah garis
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false // Menonaktifkan legend sepenuhnya
                        }
                    },
                    scales: {
                        y: {
                            min: 0,
                            max: 100,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 10, 
                                callback: function(value) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            });
        });

        function updateYear() {
            const selectedYear = document.getElementById('yearSelect').value;
            window.location.href = `?year=${selectedYear}`;
        }
    </script>
@endsection