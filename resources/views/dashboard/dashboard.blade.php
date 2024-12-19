@extends('layouts.app')

@section('content')
    <div class="flex"> <!-- Kontainer utama dengan tinggi penuh -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')

        <div class="flex-1 p-10 bg-gray-200">

            {{-- konten --}}
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <span class="material-icons text-4xl">dashboard</span>
                    <h1 class="text-4xl font-bold ml-3">
                        Dashboard
                    </h1>
                </div>

                <div class="flex space-x-4 mb-8 ">
                    {{-- User --}}
                    <div class="bg-white p-4 rounded-lg flex items-center gap-14 justify-center w-1/3 py-12 font-bold">
                        <div>
                            <i class="fas fa-user text-blue-600 text-6xl"></i>
                        </div>
                        <div class="text-3xl">
                            <p>User</p>
                            <p class="text-center mt-2">{{ $userCount }}</p>
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="bg-white p-4 rounded-lg flex items-center gap-14 justify-center w-1/3 py-12 font-bold">
                        <div>
                            <i class="fas fa-tags text-blue-600 text-5xl"></i>
                        </div>
                        <div class="text-3xl">
                            <p>Kategori</p>
                            <p class="text-center mt-2">{{ $kategoriCount }}</p>
                        </div>
                    </div>

                    {{-- Arsip --}}
                    <div class="bg-white p-4 rounded-lg flex items-center gap-14 justify-center w-1/3 py-12 font-bold">
                        <div>
                            <i class="fas fa-download text-blue-600 text-5xl"></i>
                        </div>
                        <div class="text-3xl">
                            <p>Arsip</p>
                            <p class="text-center mt-2">{{ $arsipCount }}</p>
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
                                    <option value="{{ $item->tahun }}" @if($item->tahun == $year) selected @endif>{{ $item->tahun }}</option>
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
            gradient.addColorStop(1, 'rgba(0, 0, 123, 1)');   // Warna biru tua
    
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
                        label: 'Arsip Masuk Bulanan',
                        data: Object.values(data), // Data arsip per bulan
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: gradient, // Menggunakan gradasi untuk garis
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(0, 123, 255, 1)', // Warna titik biru muda
                        pointBorderColor: 'rgba(0, 123, 255, 1)', // Warna border titik biru muda
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        fill: true // Menonaktifkan area berwarna di bawah garis
                    }]
                },
                options: {
                    scales: {
                        y: {
                            min: 0,   // Set minimal value of y-axis to 0
                            max: 2000,  // Set maximum value of y-axis to 100
                            beginAtZero: true,  // Start the scale from zero
                            ticks: {
                            stepSize: 200,  // Ubah step size menjadi 200
                            callback: function(value) {
                                return value; // Tampilkan nilai kelipatan 200
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