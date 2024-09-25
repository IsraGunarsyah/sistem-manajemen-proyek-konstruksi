<!-- resources/views/admin/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/d9247fd719.js" crossorigin="anonymous"></script>

</head>
<body class="bg-gray-100 h-screen flex flex-col md:flex-row">
    <!-- Sidebar -->
    <div class="w-64 bg-[#1B1B48] h-full fixed md:relative z-50 transform transition-transform md:translate-x-0" id="sidebar">
        @include('admin.partials.sidebar')
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        @yield('content')
    </div>

    <!-- Button toggle sidebar di mobile -->
    <button class="fixed bottom-4 right-4 bg-yellow-400 text-white p-4 rounded-full shadow-lg z-50 md:hidden" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </button>

    <script>
        
        // Script untuk toggle sidebar di layar mobile
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('toggleSidebar');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });



        
    </script>
</body>
</html>
