<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengaduan Masyarakat</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="text-white min-h-screen bg-gradient-to-br from-blue-950 via-black to-indigo-950">

<!-- HERO SECTION -->
<section class="relative min-h-screen flex items-center justify-center px-6 text-center">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-950 via-black to-indigo-950"></div>
    <div class="absolute top-1/3 left-1/4 w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-60 h-60 bg-purple-500/20 rounded-full blur-2xl animate-ping"></div>

    <div class="relative z-10 max-w-4xl">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight tracking-tight drop-shadow-xl">
            Selamat Datang di<br>
            <span class="bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">
                Sistem Pengaduan Masyarakat
            </span>
        </h1>
        <p class="mt-6 text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
            Sampaikan aspirasi, keluhan, atau saran Anda secara online. Mudah, aman, dan transparan.
        </p>

        <div class="mt-10 flex justify-center gap-4 flex-wrap">
            <a href="/login" class="px-6 py-3 bg-cyan-500 text-white font-semibold rounded-full shadow-lg hover:bg-cyan-600 hover:scale-105 transition-all">
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
            </a>
            <a href="/register" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-full shadow-lg hover:bg-purple-700 hover:scale-105 transition-all">
                <i class="fas fa-user-plus mr-2"></i> Daftar
            </a>
        </div>
    </div>
</section>

<!-- FITUR SECTION -->
<section class="relative py-20 text-center">
    <div class="absolute top-0 left-1/4 w-80 h-80 bg-cyan-400/10 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-10 right-0 w-72 h-72 bg-pink-500/10 rounded-full blur-2xl animate-pulse"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-14 text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400">
            🚀 Fitur Unggulan
        </h2>

        <div class="grid gap-10 md:grid-cols-3">
            @foreach([
                ['icon' => 'bolt', 'title' => 'Pelaporan Kilat', 'desc' => 'Laporkan masalah hanya dalam beberapa langkah dengan antarmuka yang ramah pengguna.'],
                ['icon' => 'shield-alt', 'title' => 'Keamanan Terjamin', 'desc' => 'Data Anda aman dengan enkripsi dan autentikasi berlapis.'],
                ['icon' => 'eye', 'title' => 'Status Real-Time', 'desc' => 'Pantau perkembangan laporan langsung melalui dashboard pribadi.']
            ] as $fitur)
                <div class="group bg-white/5 border border-white/10 backdrop-blur-xl rounded-2xl p-8 transition-all duration-300 hover:border-cyan-400 hover:shadow-cyan-500/20 hover:shadow-xl hover:scale-105">
                    <div class="text-cyan-300 text-4xl mb-4 group-hover:text-cyan-400 transition">
                        <i class="fas fa-{{ $fitur['icon'] }}"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">{{ $fitur['title'] }}</h3>
                    <p class="text-gray-300">{{ $fitur['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section class="relative py-20">
    <div class="absolute top-10 left-1/4 w-80 h-80 bg-cyan-400/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-purple-500/20 rounded-full blur-2xl"></div>

    <div class="relative z-10 max-w-5xl mx-auto text-center px-6">
        <h2 class="text-4xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400">
            Tentang Aplikasi Ini
        </h2>
        <p class="text-lg text-gray-300 leading-relaxed">
            Aplikasi ini menjadi jembatan digital antara masyarakat dan instansi pemerintah. Dibangun dengan teknologi web modern untuk menyederhanakan proses pelaporan, mempercepat respons, dan meningkatkan akuntabilitas publik.
        </p>
    </div>
</section>

<!-- FOOTER -->
<footer class="py-6 text-center text-sm text-gray-400">
    <p>&copy; {{ date('Y') }} <span class="font-semibold text-cyan-400">Sistem Pengaduan Masyarakat</span>. Dibuat dengan ❤️ oleh Tim Instansi.</p>
    <p class="mt-1">
        <a href="#" class="text-cyan-400 hover:underline">Kebijakan Privasi</a> |
        <a href="#" class="text-cyan-400 hover:underline">Syarat & Ketentuan</a>
    </p>
</footer>

</body>
</html>
