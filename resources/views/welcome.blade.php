<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-white via-blue-50 to-blue-100 min-h-screen flex flex-col text-gray-800">

    {{-- HERO --}}
    <section class="relative min-h-[85vh] flex items-center justify-center px-6 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-300/30 to-white/50 blur-3xl"></div>

        <div class="relative z-10 max-w-5xl text-center p-10 bg-white/60 backdrop-blur-md rounded-3xl shadow-2xl border border-white/20">
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight drop-shadow-sm">
                Selamat Datang di<br>
                <span class="text-blue-600">Pengaduan Masyarakat</span>
            </h1>
            <p class="mt-4 text-lg text-gray-700">Sampaikan aspirasi, keluhan, atau saran Anda secara online. Praktis, aman, dan transparan.</p>

            <div class="flex justify-center gap-4 mt-8 flex-wrap">
                <a href="/login" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg hover:bg-blue-700 hover:scale-105 transition-all">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </a>
                <a href="/register" class="px-6 py-3 bg-green-500 text-white font-semibold rounded-full shadow-lg hover:bg-green-600 hover:scale-105 transition-all">
                    <i class="fas fa-user-plus mr-2"></i> Daftar
                </a>
            </div>
        </div>
    </section>

    {{-- FITUR --}}
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-14">
                <span class="text-blue-600">🚀</span> Fitur Unggulan
            </h2>
            <div class="grid gap-10 md:grid-cols-3">
                @foreach([
                    ['icon' => 'bolt', 'title' => 'Pelaporan Kilat', 'desc' => 'Laporkan masalah hanya dalam beberapa langkah dengan antarmuka yang ramah pengguna.'],
                    ['icon' => 'shield-alt', 'title' => 'Keamanan Terjamin', 'desc' => 'Data Anda aman dengan enkripsi dan autentikasi berlapis.'],
                    ['icon' => 'eye', 'title' => 'Status Real-Time', 'desc' => 'Pantau perkembangan laporan langsung melalui dashboard pribadi.']
                ] as $fitur)
                    <div class="bg-gradient-to-br from-white to-blue-50 border border-gray-200 rounded-xl p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="text-blue-600 text-4xl mb-4">
                            <i class="fas fa-{{ $fitur['icon'] }}"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $fitur['title'] }}</h3>
                        <p class="text-gray-600">{{ $fitur['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section class="py-20 bg-gradient-to-r from-blue-50 via-white to-blue-50">
        <div class="max-w-5xl mx-auto text-center px-6">
            <h2 class="text-3xl font-bold mb-4 text-gray-800">Tentang Aplikasi Ini</h2>
            <p class="text-lg text-gray-700 leading-relaxed">
                Aplikasi ini menjadi jembatan digital antara masyarakat dan instansi pemerintah. Dibangun dengan teknologi web modern untuk menyederhanakan proses pelaporan, mempercepat respons, dan meningkatkan akuntabilitas publik.
            </p>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-100 border-t border-gray-300 py-6 text-center text-sm text-gray-600">
        <p>&copy; {{ date('Y') }} <span class="font-semibold text-blue-600">Sistem Pengaduan Masyarakat</span>. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-500 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-500 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>

</body>
</html>
