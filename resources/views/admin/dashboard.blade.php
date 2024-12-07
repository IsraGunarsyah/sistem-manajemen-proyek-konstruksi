@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Heading -->
<h1 class="text-3xl font-extrabold text-gray-800 mb-8 fade-in">Dashboard Admin</h1>

<!-- Container Grafik -->
<div class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-lg shadow-md zoom-in">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Grafik Pekerjaan</h2>
    <!-- Membungkus canvas dengan div berukuran penuh -->
    <div class="relative w-full" style="height: 500px;"> <!-- Ukuran tinggi diperbesar -->
        <canvas id="pekerjaanChart" class="rounded-lg border border-gray-200"></canvas>
    </div>
</div>

<!-- Custom Style -->
<style>
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes zoomIn {
        0% { opacity: 0; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }

    .fade-in { animation: fadeIn 1s ease-out; }
    .zoom-in { animation: zoomIn 1s ease-out; }
</style>

<script>
    var ctx = document.getElementById('pekerjaanChart').getContext('2d');

    // Data dari controller
    var months = @json($months); // Label bulan
    var activeData = @json(array_values($activeData)); // Data pekerjaan aktif
    var completedData = @json(array_values($completedData)); // Data pekerjaan selesai

    // Membuat Chart.js grafik
    var pekerjaanChart = new Chart(ctx, {
        type: 'line', // Menggunakan line chart
        data: {
            labels: months, // Label sumbu X (bulan)
            datasets: [{
                label: 'Pekerjaan Aktif',
                data: activeData, // Data pekerjaan aktif
                borderColor: '#4F46E5', // Warna garis (Indigo)
                backgroundColor: 'rgba(79, 70, 229, 0.2)', // Warna area (Indigo dengan transparansi)
                fill: true,
                tension: 0.3, // Membuat garis lebih mulus
                pointBorderColor: '#4F46E5', // Warna lingkaran titik
                pointBackgroundColor: '#FFFFFF', // Warna isi lingkaran titik
                pointBorderWidth: 2,
                pointHoverRadius: 6, // Radius titik saat hover
            },
            {
                label: 'Pekerjaan Selesai',
                data: completedData, // Data pekerjaan selesai
                borderColor: '#EF4444', // Warna garis (Merah)
                backgroundColor: 'rgba(239, 68, 68, 0.2)', // Warna area (Merah dengan transparansi)
                fill: true,
                tension: 0.3, // Membuat garis lebih mulus
                pointBorderColor: '#EF4444', // Warna lingkaran titik
                pointBackgroundColor: '#FFFFFF', // Warna isi lingkaran titik
                pointBorderWidth: 2,
                pointHoverRadius: 6, // Radius titik saat hover
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Grafik responsif dengan aspek ratio dinamis
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#4B5563', // Warna angka sumbu Y
                        font: { size: 14 }
                    },
                    grid: {
                        color: '#E5E7EB' // Warna grid
                    }
                },
                x: {
                    ticks: {
                        color: '#4B5563', // Warna angka sumbu X
                        font: { size: 14 }
                    },
                    grid: {
                        display: false // Hilangkan garis grid untuk sumbu X
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#374151', // Warna teks legenda
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    backgroundColor: '#1F2937', // Warna latar belakang tooltip
                    titleColor: '#FFFFFF', // Warna judul tooltip
                    bodyColor: '#F9FAFB', // Warna isi tooltip
                    titleFont: { weight: 'bold' },
                    padding: 10, // Jarak dalam tooltip
                    caretSize: 6 // Ukuran caret (segitiga)
                }
            }
        }
    });
</script>
@endsection
