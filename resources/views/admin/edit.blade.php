<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col font-sans">
    @include('components.navbar')

    <main class="flex-grow p-6 max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-blue-700 mb-6">✏️ Edit Pengaduan</h1>

        {{-- Flash message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4 border border-red-300">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/pengaduan/{{ $pengaduan->id }}" method="POST" enctype="multipart/form-data" class="space-y-5 bg-white p-6 rounded-xl shadow-md">
            @csrf
            @method('PUT')

            <div>
                <label for="judul" class="block font-semibold text-gray-700 mb-1">Judul Pengaduan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $pengaduan->judul) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="isi" class="block font-semibold text-gray-700 mb-1">Isi Pengaduan</label>
                <textarea name="isi" id="isi" rows="6"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('isi', $pengaduan->isi) }}</textarea>
            </div>

            @if ($pengaduan->foto)
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Foto Saat Ini:</label>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="w-48 rounded shadow mb-3">
                </div>
            @endif

            <div>
                <label for="foto" class="block mb-1 text-sm text-gray-600">Foto (opsional)</label>
                <input type="file" name="foto" id="foto"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                              file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100">
            </div>

            <div class="flex justify-between">
                <a href="/admin" class="bg-gray-300 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-400 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </main>

    <footer class="mt-auto bg-gray-100 border-t border-gray-200 py-6 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>
</body>
</html>
