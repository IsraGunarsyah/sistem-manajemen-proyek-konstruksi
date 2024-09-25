<!-- resources/views/admin/partials/sidebar.blade.php -->
<div class="w-full md:w-64 bg-[#1B1B48] h-screen flex flex-col">
    <div class="flex flex-col items-center py-10">
        <!-- Icon User -->
        <div class="text-white mb-4">
            <i class="fas fa-user-circle text-6xl"></i>
        </div>
        <!-- Nama User -->
        <div class="text-white text-xl">
            {{ Auth::user()->name }}
        </div>
        <div class="text-sm text-gray-300">Pengawas Lapangan</div>
    </div>

    <!-- Menu Navigasi -->
    <div class="flex flex-col flex-grow space-y-4 px-4">
        <a href="{{ route('user.dashboard') }}" class="bg-yellow-400 text-white font-bold py-3 rounded-md text-center hover:bg-yellow-500 w-full">Dashboard</a>
        <a href="{{ route('user.pekerjaan.index') }}" class="bg-yellow-400 text-white font-bold py-3 rounded-md text-center hover:bg-yellow-500 w-full">Pekerjaan</a>
        <a href="{{ route('user.pekerjaan.progress-lapangan') }}" class="bg-yellow-400 text-white font-bold py-3 rounded-md text-center hover:bg-yellow-500 w-full">Progress Lapangan</a>
        <a href="{{ route('user.pekerjaan.riwayat-laporan') }}" class="bg-yellow-400 text-white font-bold py-3 rounded-md text-center hover:bg-yellow-500 w-full">Riwayat Laporan</a>
    </div>

    <!-- Tombol Logout -->
    <div class="mt-auto px-4 py-4">
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button class="w-full bg-blue-500 text-white font-bold py-3 rounded-md focus:outline-none hover:bg-blue-600">
                Logout
            </button>
        </form>
    </div>
</div>
