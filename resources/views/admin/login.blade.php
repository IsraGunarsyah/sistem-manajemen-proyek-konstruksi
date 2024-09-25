<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/d9247fd719.js" crossorigin="anonymous"></script>
</head>
<body class="h-screen bg-gray-100">
    <div class="flex h-full">
        <!-- Bagian Gambar -->
        <div class="hidden md:block md:w-1/2 bg-cover bg-center" style="background-image: url('/img/login-foto.png');">
        </div>

        <!-- Bagian Form Login -->
        <div class="flex items-center justify-center w-full md:w-1/2">
            <div class="w-3/4 max-w-md">
                <div class="text-center mb-8">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-50 mx-auto">
                    <h2 class="mt-4 text-3xl font-bold text-[#6086CD]">Selamat Datang!</h2>
                    <p class="mt-2 text-gray-600">Silahkan login terlebih dahulu</p>
                </div>
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <!-- Input Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md bg-yellow-400 text-white">
                                <i class="fas fa-envelope"></i> <!-- Ikon email dari Font Awesome -->
                            </span>
                            <input type="email" name="email" id="email" class="block w-full flex-1 rounded-r-md bg-yellow-400 text-white placeholder-white border-yellow-400 focus:ring-yellow-300 focus:border-yellow-300 text-lg py-3 px-4" placeholder="Email" required>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md bg-yellow-400 text-white">
                                <i class="fas fa-lock"></i> <!-- Ikon password dari Font Awesome -->
                            </span>
                            <input type="password" name="password" id="password" class="block w-full flex-1 rounded-r-md bg-yellow-400 text-white placeholder-white border-yellow-400 focus:ring-yellow-300 focus:border-yellow-300 text-lg py-3 px-4" placeholder="Password" required>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit" class="w-full bg-[#6086CD] hover:bg-yellow-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
