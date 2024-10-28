@extends('layouts.app')

@section('content')
    <div class="flex "> <!-- Kontainer utama dengan tinggi penuh -->

        {{-- Include sidebar --}}
        @include('layouts.sidebar')

        <div class="flex-1 p-10 bg-gray-100">

            {{-- konten --}}


            {{-- Judul Dashboard --}}

            <!-- Main Content -->
            <div class=" p-8 ">

                <div class="flex items-center mb-8">
                    <span class="material-icons text-4xl">dashboard</span>
                    <h1 class="text-4xl font-bold ml-3">
                        Dashboard
                    </h1>
                </div>

                <div class="flex space-x-4 mb-8 ">
                    {{-- User --}}
                    <div class="bg-gray-200 p-4 rounded-lg flex items-center gap-14 justify-center w-1/3 py-12 font-bold">
                        <div>
                            <i class="fas fa-user text-blue-600 text-6xl"></i>
                        </div>
                        <div class="text-3xl">
                            <p>User</p>
                            <p class="text-center mt-2">{{ $userCount }}</p>
                        </div>
                    </div>
                    
                    {{-- Kategori --}}
                    <div class="bg-gray-200 p-4 rounded-lg flex items-center gap-14 justify-center w-1/3 py-12 font-bold">
                        <div>
                            <i class="fas fa-tags text-blue-600 text-5xl"></i>
                        </div>
                        <div class="text-3xl">
                            <p>Kategori</p>
                            <p class="text-center mt-2">{{ $kategoriCount }}</p>
                        </div>
                    </div>
                    
                    {{-- Arsip --}}
                    <div class="bg-gray-200 p-4 rounded-lg flex items-center gap-14 justify-center w-1/3 py-12 font-bold">
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
                <div class="bg-gray-200 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">
                            Arsip Masuk Bulanan
                        </h2>
                        <div class="flex space-x-2">
                            <select class="p-2 border rounded" id="yearSelect">
                                <option value="2024">
                                    2024
                                </option>
                                <option value="2023">
                                    2023
                                </option>
                                <option value="2022">
                                    2022
                                </option>
                            </select>
                            <select class="p-2 border rounded" id="monthSelect">
                                <option value="all">
                                    Semua Bulan
                                </option>
                                <option value="Januari">
                                    Januari
                                </option>
                                <option value="Februari">
                                    Februari
                                </option>
                                <option value="Maret">
                                    Maret
                                </option>
                                <option value="April">
                                    April
                                </option>
                                <option value="Mei">
                                    Mei
                                </option>
                                <option value="Juni">
                                    Juni
                                </option>
                                <option value="Juli">
                                    Juli
                                </option>
                                <option value="Agustus">
                                    Agustus
                                </option>
                                <option value="September">
                                    September
                                </option>
                                <option value="Oktober">
                                    Oktober
                                </option>
                                <option value="November">
                                    November
                                </option>
                                <option value="Desember">
                                    Desember
                                </option>
                            </select>
                        </div>
                    </div>
                    <canvas height="200" id="myChart" width="600">
                    </canvas>
                    <div class="hidden" id="chartData">
                        <div data-year="2024">
                            <span data-label="Januari" data-value="10">
                            </span>
                            <span data-label="Februari" data-value="20">
                            </span>
                            <span data-label="Maret" data-value="30">
                            </span>
                            <span data-label="April" data-value="40">
                            </span>
                            <span data-label="Mei" data-value="50">
                            </span>
                            <span data-label="Juni" data-value="60">
                            </span>
                            <span data-label="Juli" data-value="70">
                            </span>
                            <span data-label="Agustus" data-value="80">
                            </span>
                            <span data-label="September" data-value="90">
                            </span>
                            <span data-label="Oktober" data-value="100">
                            </span>
                            <span data-label="November" data-value="110">
                            </span>
                            <span data-label="Desember" data-value="120">
                            </span>
                        </div>
                        <div data-year="2023">
                            <span data-label="Januari" data-value="15">
                            </span>
                            <span data-label="Februari" data-value="25">
                            </span>
                            <span data-label="Maret" data-value="35">
                            </span>
                            <span data-label="April" data-value="45">
                            </span>
                            <span data-label="Mei" data-value="55">
                            </span>
                            <span data-label="Juni" data-value="65">
                            </span>
                            <span data-label="Juli" data-value="75">
                            </span>
                            <span data-label="Agustus" data-value="85">
                            </span>
                            <span data-label="September" data-value="95">
                            </span>
                            <span data-label="Oktober" data-value="105">
                            </span>
                            <span data-label="November" data-value="115">
                            </span>
                            <span data-label="Desember" data-value="125">
                            </span>
                        </div>
                        <div data-year="2022">
                            <span data-label="Januari" data-value="20">
                            </span>
                            <span data-label="Februari" data-value="30">
                            </span>
                            <span data-label="Maret" data-value="40">
                            </span>
                            <span data-label="April" data-value="50">
                            </span>
                            <span data-label="Mei" data-value="60">
                            </span>
                            <span data-label="Juni" data-value="70">
                            </span>
                            <span data-label="Juli" data-value="80">
                            </span>
                            <span data-label="Agustus" data-value="90">
                            </span>
                            <span data-label="September" data-value="100">
                            </span>
                            <span data-label="Oktober" data-value="110">
                            </span>
                            <span data-label="November" data-value="120">
                            </span>
                            <span data-label="Desember" data-value="130">
                            </span>
                        </div>
                    </div>
                </div>




            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const chartData = document.getElementById('chartData');
                    const yearSelect = document.getElementById('yearSelect');
                    const monthSelect = document.getElementById('monthSelect');
                    const ctx = document.getElementById('myChart').getContext('2d');

                    function updateChart(year, month) {
                        const selectedData = chartData.querySelector(`div[data-year="${year}"]`);
                        const labels = [];
                        const data = [];

                        selectedData.querySelectorAll('span').forEach(span => {
                            const label = span.getAttribute('data-label');
                            const value = span.getAttribute('data-value');
                            if (month === 'all' || month === label) {
                                labels.push(label);
                                data.push(value);
                            }
                        });

                        myChart.data.labels = labels;
                        myChart.data.datasets[0].data = data;
                        myChart.update();
                    }

                    const myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                label: 'Arsip Masuk Bulanan',
                                data: [],
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                                pointBorderColor: 'rgba(54, 162, 235, 1)',
                                pointRadius: 3,
                                pointHoverRadius: 5,
                                fill: true
                            }]
                        },
                        
                    });

                    yearSelect.addEventListener('change', function() {
                        updateChart(this.value, monthSelect.value);
                    });

                    monthSelect.addEventListener('change', function() {
                        updateChart(yearSelect.value, this.value);
                    });

                    // Initialize chart with the first year and all months
                    updateChart(yearSelect.value, monthSelect.value);
                });
            </script>


        </div>
    </div>

{{-- Charts nya --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
