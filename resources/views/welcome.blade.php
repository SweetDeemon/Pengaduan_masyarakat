<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script> {{-- Ganti dengan FontAwesome Kit ID --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-50 min-h-screen flex flex-col">

    {{-- HERO --}}
    <section class="relative min-h-[80vh] flex items-center justify-center px-6">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-200 via-white to-blue-100 opacity-40 blur-xl"></div>

        <div class="relative z-10 max-w-4xl w-full text-center p-10 bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">Selamat Datang!</h1>
            <p class="mt-4 text-lg text-gray-600">Sampaikan aspirasi, keluhan, atau saran Anda dengan mudah dan aman. Aplikasi ini hadir untuk pelayanan publik yang lebih baik.</p>

            <div class="flex justify-center gap-4 mt-8 flex-wrap">
                <a href="/login" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-md hover:bg-blue-700 transition hover:scale-105 duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
                <a href="/register" class="px-6 py-3 bg-green-500 text-white font-semibold rounded-full shadow-md hover:bg-green-600 transition hover:scale-105 duration-200">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>
            </div>
        </div>
    </section>

    {{-- FITUR --}}
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12"><span class="text-yellow-500">✨</span> Fitur Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach([
                    ['icon' => 'bolt', 'title' => 'Pelaporan Kilat', 'desc' => 'Laporkan masalah hanya dalam beberapa langkah dengan antarmuka yang user-friendly.'],
                    ['icon' => 'shield-alt', 'title' => 'Keamanan Terjamin', 'desc' => 'Data Anda aman dengan sistem perlindungan berlapis dan enkripsi modern.'],
                    ['icon' => 'eye', 'title' => 'Status Real-Time', 'desc' => 'Lihat perkembangan pengaduan secara langsung dari dashboard pengguna.']
                ] as $fitur)
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 duration-200">
                        <i class="fas fa-{{ $fitur['icon'] }} text-3xl text-blue-600 mb-4"></i>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $fitur['title'] }}</h3>
                        <p class="text-gray-600">{{ $fitur['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section class="bg-gradient-to-r from-blue-50 via-white to-blue-50 py-16">
        <div class="max-w-5xl mx-auto text-center px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Tentang Aplikasi Ini</h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                Aplikasi ini merupakan jembatan komunikasi antara masyarakat dan instansi pemerintah. Dibuat dengan teknologi modern untuk memastikan kemudahan, kecepatan, dan kejelasan dalam proses pelaporan serta penanganan pengaduan Anda.
            </p>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-100 border-t border-gray-200 py-6 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>

</body>
</html>
