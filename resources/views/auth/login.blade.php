<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        fadeIn: 'fadeIn 1s ease-in-out both',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: 0, transform: 'translateY(10px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen flex items-center justify-center font-inter">

    <div class="w-full max-w-sm bg-white p-8 rounded-3xl shadow-2xl animate-fadeIn">
        <h2 class="text-3xl font-extrabold text-center mb-6 text-blue-700">Login</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block mb-1 text-sm text-gray-600">Email</label>
                <input type="email" name="email" id="email" required placeholder="Masukkan email" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="password" class="block mb-1 text-sm text-gray-600">Password</label>
                <input type="password" name="password" id="password" required placeholder="Masukkan password" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500" />
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition duration-200">
                Masuk
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-500">
            Belum punya akun? <a href="/register" class="text-blue-600 hover:underline">Daftar di sini</a>
        </p>
    </div>

</body>
</html>
