<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi Progress - {{ $progress->pekerjaan->nama_pekerjaan }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <div class="container mx-auto px-6 py-12">
        <!-- Title Section -->
        <h1 class="text-4xl font-semibold text-gray-900 mb-8 text-center">
            Dokumentasi Progress - {{ $progress->pekerjaan->nama_pekerjaan }}
        </h1>

        <!-- Button Kembali -->
        <a href="{{ route('admin.laporan.detail', $progress->pekerjaan->id) }}" 
            class="inline-block bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700 transition duration-300 ease-in-out mb-8 text-lg">
            Kembali
        </a>

        <!-- If there are photos available -->
        @if ($progress->foto)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach (json_decode($progress->foto) as $foto)
                    <div class="group transform transition-all hover:scale-105">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $foto) }}" alt="Dokumentasi Progress" class="w-full h-72 object-cover rounded-t-xl transition duration-300 ease-in-out">
                            <div class="p-4">
                                <span class="text-lg font-semibold text-gray-700">Dokumentasi Foto</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-red-600 text-white p-6 rounded-xl shadow-md text-center">
                <p class="text-lg font-semibold">Tidak ada dokumentasi untuk progress ini.</p>
            </div>
        @endif
    </div>

</body>

</html>
