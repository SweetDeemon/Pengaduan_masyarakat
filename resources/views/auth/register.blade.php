<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register - Pengaduan Masyarakat</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
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
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-black to-indigo-950 font-inter flex items-center justify-center relative overflow-hidden">

    <!-- Background Glow -->
    <div class="absolute w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl top-20 left-10 animate-pulse"></div>
    <div class="absolute w-80 h-80 bg-purple-500/20 rounded-full blur-2xl bottom-10 right-10 animate-pulse"></div>

    <!-- Register Form Card -->
    <div class="relative z-10 w-full max-w-md bg-white/5 border border-white/10 backdrop-blur-xl text-white p-8 rounded-2xl shadow-lg animate-fadeInUp">

        <h2 class="text-3xl font-extrabold text-center mb-6 bg-gradient-to-r from-cyan-400 to-purple-500 text-transparent bg-clip-text">
            Daftar Akun Baru
        </h2>

        @if ($errors->any())
            <div class="bg-red-600/10 text-red-400 p-3 rounded-lg mb-4 text-sm border border-red-500/30">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block mb-1 text-sm text-cyan-300">Nama Lengkap</label>
                <input type="text" name="name" id="name" required placeholder="Nama lengkap"
                       class="w-full p-3 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 placeholder:text-gray-300"/>
            </div>

            <div>
                <label for="email" class="block mb-1 text-sm text-cyan-300">Email</label>
                <input type="email" name="email" id="email" required placeholder="Alamat email"
                       class="w-full p-3 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 placeholder:text-gray-300"/>
            </div>

            <div>
                <label for="password" class="block mb-1 text-sm text-cyan-300">Password</label>
                <input type="password" name="password" id="password" required placeholder="Kata sandi"
                       class="w-full p-3 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 placeholder:text-gray-300"/>
            </div>

            <div>
                <label for="password_confirmation" class="block mb-1 text-sm text-cyan-300">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi kata sandi"
                       class="w-full p-3 bg-white/10 border border-white/20 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 placeholder:text-gray-300"/>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-xl font-semibold hover:scale-105 transition-all duration-200">
                Daftar
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-300">
            Sudah punya akun?
            <a href="/login" class="text-cyan-400 hover:underline font-medium">Login di sini</a>
        </p>
    </div>

</body>
</html>
