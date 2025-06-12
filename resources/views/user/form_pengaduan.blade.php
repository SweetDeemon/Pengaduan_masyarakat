<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan</title>

    {{-- Tailwind via Vite --}}
    @vite('resources/css/app.css')

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-inter flex flex-col min-h-screen">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- FORM --}}
    <div class="max-w-3xl mx-auto py-12 px-6 flex-grow">
        <form action="/pengaduan" method="POST" enctype="multipart/form-data"
              class="bg-white p-8 rounded-2xl shadow-xl space-y-6 animate-fadeIn">
            @csrf
            <h2 class="text-3xl font-bold text-gray-800">Buat Pengaduan Baru</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="judul" class="block mb-1 text-sm text-gray-600">Judul Pengaduan</label>
                <input type="text" name="judul" id="judul" required
                       class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"
                       placeholder="Contoh: Jalan rusak di depan rumah">
            </div>

            <div>
                <label for="isi" class="block mb-1 text-sm text-gray-600">Isi Pengaduan</label>
                <textarea name="isi" id="isi" required rows="4"
                          class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"
                          placeholder="Tulis keluhan atau laporan Anda secara lengkap..."></textarea>
            </div>

            <div>
                <label for="foto" class="block mb-1 text-sm text-gray-600">Foto (opsional)</label>
                <input type="file" name="foto" id="foto"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                              file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-200">
                Kirim Pengaduan
            </button>
        </form>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-gray-100 border-t border-gray-200 py-6 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>

    {{-- Font Awesome (opsional jika belum ada di layout) --}}
    <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script> {{-- Ganti dengan kit ID milikmu --}}

</body>
</html>
