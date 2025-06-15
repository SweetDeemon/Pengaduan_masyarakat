<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col font-inter bg-gradient-to-b from-[#0f172a] to-[#1e293b] text-white">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Konten --}}
    <main class="flex-grow py-10 px-4 w-full max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-white mb-6 flex items-center gap-2">
            ✏️ Edit Pengaduan
        </h1>

        {{-- Flash message --}}
        @if (session('success'))
            <div class="bg-green-600/20 border border-green-400 text-green-300 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-600/20 border border-red-400 text-red-300 p-4 rounded mb-4">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/pengaduan/{{ $pengaduan->id }}" method="POST" enctype="multipart/form-data" class="space-y-5 bg-white/5 backdrop-blur-md p-6 rounded-xl border border-white/10 shadow-md">
            @csrf
            @method('PUT')

            <div>
                <label for="judul" class="block font-semibold text-gray-300 mb-1">Judul Pengaduan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $pengaduan->judul) }}"
                    class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 placeholder-gray-400">
            </div>

            <div>
                <label for="isi" class="block font-semibold text-gray-300 mb-1">Isi Pengaduan</label>
                <textarea name="isi" id="isi" rows="6"
                    class="w-full bg-white/10 text-white border border-white/20 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 placeholder-gray-400">{{ old('isi', $pengaduan->isi) }}</textarea>
            </div>

            @if ($pengaduan->foto)
                <div>
                    <label class="block font-semibold text-gray-300 mb-1">Foto Saat Ini:</label>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="w-48 rounded shadow mb-3">
                </div>
            @endif

            <div>
                <label for="foto" class="block mb-1 text-sm text-gray-400">Foto (opsional)</label>
                <input type="file" name="foto" id="foto"
                       class="w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                              file:text-sm file:font-semibold file:bg-cyan-100/10 file:text-cyan-400
                              hover:file:bg-cyan-100/20">
            </div>

            <div class="flex justify-between">
                <a href="/admin" class="bg-white/10 text-white px-5 py-2 rounded-lg border border-white/20 hover:bg-white/20 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-6 py-2 rounded-lg hover:opacity-90 transition font-semibold">
                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </main>

    {{-- Footer --}}
    <footer class="text-sm text-gray-400 text-center py-6 border-t border-white/10">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-cyan-400 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-cyan-400 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>

</body>
</html>
