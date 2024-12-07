<!-- resources/views/admin/partials/sidebar.blade.php -->
<div class="w-full md:w-64 bg-[#1B1B48] h-full flex flex-col">
    <div class="flex flex-col items-center py-10">
        <div class="text-white mb-4">
            <i class="fas fa-user-circle text-6xl"></i>
        </div>
        <div class="text-white text-xl mb-8">
            {{ Auth::user()->name ?? 'Admin' }}
        </div>
    </div>

    <div class="flex flex-col flex-grow space-y-4 px-4">
        <a href="{{ route('admin.dashboard') }}" class="bg-yellow-400 text-white font-bold py-3 rounded-md text-center hover:bg-yellow-500 w-full">Dashboard</a>
        <a href="{{ route('admin.laporan') }}" class="bg-yellow-400 text-white font-bold py-3 rounded-md text-center hover:bg-yellow-500 w-full">Laporan</a>
        <a href="{{ route('admin.pekerjaan.index') }}" class="bg-yellow-400 text-white font-bold py-3 rounded-md text-center hover:bg-yellow-500 w-full">Pekerjaan</a>
        <a href="{{ route('admin.users') }}" class="bg-yellow-400 text-white font-bold py-3 rounded-md text-center hover:bg-yellow-500 w-full">Data Pengawas</a>
        <a href="{{ route('admin.registerUser') }}" class="bg-green-500 text-white font-bold py-3 rounded-md text-center hover:bg-green-600 w-full">Registrasi Akun User</a>
    </div>

    <div class="mt-auto px-4 py-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-blue-500 text-white font-bold py-3 rounded-md focus:outline-none hover:bg-blue-600">
                Logout
            </button>
        </form>
    </div>
</div>
