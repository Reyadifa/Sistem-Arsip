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
                    <div class="bg-gray-200 p-4 rounded-lg flex items-center gap-14 justify-center w-1/3 py-12  font-bold">

                       <div class="">
                            <i class="fas fa-user text-blue-600 text-6xl">
                            </i>
                        </div>

                            <div class="text-3xl">
                                <p class="">
                                    User
                                </p>
                                <p class="text-center mt-2">
                                    5
                                </p>
                            </div>
                       
                    </div>

                    {{-- Kategori --}}
                    <div class="bg-gray-200 p-4 rounded-lg flex items-center gap-14 justify-center w-1/3 py-12 font-bold">
                        <div>
                        <i class="fas fa-tags text-blue-600 text-5xl">
                        </i>
                    </div>
                        <div class="text-3xl">
                            <p class="">
                                Kategori
                            </p>
                            <p class="text-center mt-2">
                                8
                            </p>
                        </div>
                    </div>

                    {{-- Arsip --}}
                    <div class="bg-gray-200 p-4 rounded-lg flex items-center gap-14 justify-center  space-x-2 w-1/3 py-12 font-bold">
                        <div>
                        <i class="fas fa-download text-blue-600 text-5xl">
                        </i>
                    </div>
                        <div class="text-3xl">
                            <p class="">
                                Arsip
                            </p>
                            <p class="text-center mt-2">
                                937
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Charts --}}
                <div class="bg-gray-200 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                     <h2 class="text-xl font-bold">
                      Arsip Masuk Bulanan
                     </h2>
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
                    </div>
                    <canvas height="200" id="myChart" width="600">
                    </canvas>
                    <div class="hidden" id="chartData">
                     <div data-year="2024">
                      <span data-label="Januari" data-value="100">
                      </span>
                      <span data-label="Februari" data-value="200">
                      </span>
                      <span data-label="Maret" data-value="300">
                      </span>
                      <span data-label="April" data-value="400">
                      </span>
                      <span data-label="Mei" data-value="500">
                      </span>
                      <span data-label="Juni" data-value="600">
                      </span>
                      <span data-label="Juli" data-value="700">
                      </span>
                      <span data-label="Agustus" data-value="800">
                      </span>
                      <span data-label="September" data-value="900">
                      </span>
                      <span data-label="Oktober" data-value="1000">
                      </span>
                      <span data-label="November" data-value="1100">
                      </span>
                      <span data-label="Desember" data-value="1200">
                      </span>
                     </div>
                     <div data-year="2023">
                      <span data-label="Januari" data-value="150">
                      </span>
                      <span data-label="Februari" data-value="250">
                      </span>
                      <span data-label="Maret" data-value="350">
                      </span>
                      <span data-label="April" data-value="450">
                      </span>
                      <span data-label="Mei" data-value="550">
                      </span>
                      <span data-label="Juni" data-value="650">
                      </span>
                      <span data-label="Juli" data-value="750">
                      </span>
                      <span data-label="Agustus" data-value="850">
                      </span>
                      <span data-label="September" data-value="950">
                      </span>
                      <span data-label="Oktober" data-value="1050">
                      </span>
                      <span data-label="November" data-value="1150">
                      </span>
                      <span data-label="Desember" data-value="1205">
                      </span>
                     </div>
                     <div data-year="2022">
                      <span data-label="Januari" data-value="200">
                      </span>
                      <span data-label="Februari" data-value="300">
                      </span>
                      <span data-label="Maret" data-value="400">
                      </span>
                      <span data-label="April" data-value="500">
                      </span>
                      <span data-label="Mei" data-value="600">
                      </span>
                      <span data-label="Juni" data-value="700">
                      </span>
                      <span data-label="Juli" data-value="800">
                      </span>
                      <span data-label="Agustus" data-value="900">
                      </span>
                      <span data-label="September" data-value="1000">
                      </span>
                      <span data-label="Oktober" data-value="1100">
                      </span>
                      <span data-label="November" data-value="1200">
                      </span>
                      <span data-label="Desember" data-value="1300">
                      </span>
                     </div>
                    </div>
                   </div>


            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
            const chartData = document.getElementById('chartData');
            const yearSelect = document.getElementById('yearSelect');
            const ctx = document.getElementById('myChart').getContext('2d');

            function updateChart(year) {
                const selectedData = chartData.querySelector(`div[data-year="${year}"]`);
                const labels = [];
                const data = [];

                selectedData.querySelectorAll('span').forEach(span => {
                    labels.push(span.getAttribute('data-label'));
                    data.push(span.getAttribute('data-value'));
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
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            yearSelect.addEventListener('change', function () {
                updateChart(this.value);
            });

            // Initialize chart with the first year
            updateChart(yearSelect.value);
        });
            </script>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
