<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Pengaduan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-slate-900 text-white font-sans">

    @include('components.navbar')

    <main class="flex-grow px-4">
        <div class="max-w-3xl mx-auto mt-14 bg-slate-800 p-8 rounded-2xl shadow-xl border border-slate-700 transition-all duration-300">
            <h1 class="text-3xl font-bold text-blue-500 mb-6 flex items-center gap-2">
                 Edit Pengaduan
            </h1>

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-400 text-red-300 px-4 py-3 rounded-lg mb-5 shadow">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/instansi/pengaduan/{{ $pengaduan->id }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="judul" class="block text-sm font-semibold mb-1 text-gray-300">Judul Pengaduan</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $pengaduan->judul) }}"
                        class="w-full bg-slate-900 text-white p-3 rounded-xl border border-slate-600 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                        required>
                </div>

                <div class="mb-6">
                    <label for="isi" class="block text-sm font-semibold mb-1 text-gray-300">Isi Pengaduan</label>
                    <textarea name="isi" id="isi" rows="5"
                        class="w-full bg-slate-900 text-white p-3 rounded-xl border border-slate-600 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                        required>{{ old('isi', $pengaduan->isi) }}</textarea>
                </div>

                <div class="flex justify-between items-center mt-8">
                    <a href="/instansi" class="text-sm text-gray-400 hover:text-white transition">← Batal</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition shadow">
                         Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-slate-900 text-gray-500 border-t border-slate-800 mt-16 py-6 text-center text-sm">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-400 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-400 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>

</body>
</html>
