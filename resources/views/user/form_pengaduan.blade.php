<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Form Pengaduan</title>

    {{-- Tailwind via Vite --}}
    @vite('resources/css/app.css')

    {{-- Font Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    {{-- Tailwind Custom Config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        fadeInUp: 'fadeInUp 0.8s ease-out both',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: 0, transform: 'translateY(20px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-black to-indigo-950 font-inter text-white flex flex-col">

    {{-- Background Glow --}}
    <div class="absolute w-96 h-96 bg-purple-500/20 blur-3xl rounded-full top-10 left-10 animate-pulse"></div>
    <div class="absolute w-80 h-80 bg-cyan-500/20 blur-2xl rounded-full bottom-10 right-10 animate-pulse"></div>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- FORM --}}
    <div class="relative z-10 max-w-3xl mx-auto py-16 px-6 flex-grow">
        <form action="/pengaduan" method="POST" enctype="multipart/form-data"
              class="bg-white/5 backdrop-blur-lg border border-white/10 p-10 rounded-2xl shadow-xl space-y-6 animate-fadeInUp">
            @csrf
            <h2 class="text-3xl font-bold text-transparent bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text">
                Buat Pengaduan Baru
            </h2>

            @if(session('success'))
                <div class="bg-green-600/10 text-green-400 p-4 rounded-lg border border-green-500/30">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-600/10 text-red-400 p-4 rounded-lg border border-red-500/30">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="judul" class="block mb-1 text-sm text-cyan-300">Judul Pengaduan</label>
                <input type="text" name="judul" id="judul" required
                       class="w-full p-3 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 placeholder:text-gray-300"
                       placeholder="Contoh: Jalan rusak di depan rumah">
            </div>

            <div>
                <label for="isi" class="block mb-1 text-sm text-cyan-300">Isi Pengaduan</label>
                <textarea name="isi" id="isi" required rows="4"
                          class="w-full p-3 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 placeholder:text-gray-300"
                          placeholder="Tulis keluhan atau laporan Anda secara lengkap..."></textarea>
            </div>

            <div>
                <label for="foto" class="block mb-1 text-sm text-cyan-300">Foto (opsional)</label>
                <input type="file" name="foto" id="foto"
                       class="w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full
                              file:border-0 file:text-sm file:font-semibold file:bg-cyan-50/10 file:text-cyan-300
                              hover:file:bg-cyan-100/20 cursor-pointer"/>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-xl font-semibold hover:scale-105 transition-all duration-200">
                Kirim Pengaduan
            </button>
        </form>
    </div>

    {{-- Footer --}}
    <footer class="relative z-10 bg-transparent border-t border-white/10 py-6 text-center text-sm text-gray-400">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-cyan-400 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-cyan-400 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>

</body>
</html>
