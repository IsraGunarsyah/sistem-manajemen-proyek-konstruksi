@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1 class="text-3xl font-bold text-[#1B1B48] mb-6">Dashboard Admin</h1>

<div class="bg-white p-6 rounded-md shadow-md">
    <h2 class="text-xl font-semibold mb-4">Grafik Pekerjaan</h2>
    <canvas id="pekerjaanChart" width="400" height="200"></canvas>
</div>

<script>
    var ctx = document.getElementById('pekerjaanChart').getContext('2d');

    var months = @json($months); // Mengambil nama-nama bulan dari controller
    var activeData = @json(array_values($activeData)); // Data pekerjaan aktif
    var completedData = @json(array_values($completedData)); // Data pekerjaan selesai

    var pekerjaanChart = new Chart(ctx, {
        type: 'line', // Menggunakan line chart
        data: {
            labels: months, // Label untuk sumbu X, yaitu bulan
            datasets: [{
                label: 'Pekerjaan Aktif',
                data: activeData, // Data pekerjaan aktif berdasarkan bulan
                borderColor: 'rgba(75, 192, 192, 1)', // Warna garis
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna background area
                fill: true,
                tension: 0.1, // Membuat garis lebih mulus
            },
            {
                label: 'Pekerjaan Selesai',
                data: completedData, // Data pekerjaan selesai berdasarkan bulan
                borderColor: 'rgba(255, 99, 132, 1)', // Warna garis
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna background area
                fill: true,
                tension: 0.1, // Membuat garis lebih mulus
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Memulai sumbu Y dari nol
                }
            },
            plugins: {
                legend: {
                    position: 'top', // Posisi legenda di atas
                }
            }
        }
    });
</script>

@endsection
