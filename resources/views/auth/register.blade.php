<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pengaduan Masyarakat</title>
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
<body class="bg-gradient-to-br from-green-100 to-white min-h-screen flex items-center justify-center font-inter">

    <div class="w-full max-w-sm bg-white p-8 rounded-3xl shadow-2xl animate-fadeIn">
        <h2 class="text-3xl font-extrabold text-center mb-6 text-green-700">Register</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
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
                <label for="name" class="block mb-1 text-sm text-gray-600">Nama Lengkap</label>
                <input type="text" name="name" id="name" required placeholder="Nama lengkap" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500"/>
            </div>
            <div>
                <label for="email" class="block mb-1 text-sm text-gray-600">Email</label>
                <input type="email" name="email" id="email" required placeholder="Alamat email" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500"/>
            </div>
            <div>
                <label for="password" class="block mb-1 text-sm text-gray-600">Password</label>
                <input type="password" name="password" id="password" required placeholder="Kata sandi" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500"/>
            </div>
            <div>
                <label for="password_confirmation" class="block mb-1 text-sm text-gray-600">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi kata sandi" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500"/>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 transition duration-200">
                Daftar
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-500">
            Sudah punya akun? <a href="/login" class="text-green-600 hover:underline">Login di sini</a>
        </p>
    </div>

</body>
</html>
