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
                    <h2 class="text-xl font-bold mb-4">
                        Arsip Masuk Bulanan
                    </h2>
                    <canvas height="200" id="myChart" width="600">
                    </canvas>
                    <div class="hidden" id="chartData">
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
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const chartData = document.getElementById('chartData');
                    const labels = [];
                    const data = [];

                    chartData.querySelectorAll('span').forEach(span => {
                        labels.push(span.getAttribute('data-label'));
                        data.push(span.getAttribute('data-value'));
                    });

                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: '2024',
                                data: data,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
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
                });
            </script>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
