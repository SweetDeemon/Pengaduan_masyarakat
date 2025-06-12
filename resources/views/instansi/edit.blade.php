<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-gray-100 to-white font-sans">
    @include('components.navbar')

    <main class="flex-grow">
        <div class="max-w-2xl mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
            <h1 class="text-3xl font-bold text-blue-700 mb-6">✏️ Edit Pengaduan</h1>

            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-800 p-4 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/instansi/pengaduan/{{ $pengaduan->id }}">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $pengaduan->judul) }}"
                        class="w-full mt-1 p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="mb-5">
                    <label for="isi" class="block text-sm font-medium text-gray-700">Isi</label>
                    <textarea name="isi" id="isi" rows="4"
                        class="w-full mt-1 p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"
                        required>{{ old('isi', $pengaduan->isi) }}</textarea>
                </div>

                <div class="flex justify-between items-center mt-8">
                    <a href="/instansi" class="text-sm text-gray-600 hover:underline">← Batal</a>
                    <button type="submit"
                        class="bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700 transition shadow">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-gray-100 border-t border-gray-200 py-6 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>
</body>
</html>
