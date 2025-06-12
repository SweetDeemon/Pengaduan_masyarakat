<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-gray-100 to-white font-sans">
    @include('components.navbar')

    <main class="flex-grow">
        <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
            <h1 class="text-3xl font-bold text-blue-700 mb-6 flex items-center gap-2">
                📄 Detail Pengaduan
            </h1>

            <div class="space-y-4 text-gray-800">
                <p><strong class="text-gray-600">Judul:</strong> {{ $pengaduan->judul }}</p>
                <p><strong class="text-gray-600">Isi:</strong> {{ $pengaduan->isi }}</p>
                <p>
                    <strong class="text-gray-600">Status:</strong>
                    <span class="inline-block px-3 py-1 text-sm font-medium rounded-full
                        @if($pengaduan->status === 'dikirim') bg-yellow-100 text-yellow-800
                        @elseif($pengaduan->status === 'diproses') bg-blue-100 text-blue-800
                        @elseif($pengaduan->status === 'selesai') bg-green-100 text-green-800
                        @endif">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </p>

                @if($pengaduan->foto)
                    <div>
                        <p class="text-gray-600 font-medium mb-1">Foto:</p>
                        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto" class="w-64 rounded-xl shadow-md border">
                    </div>
                @endif

                            <div class="grid md:grid-cols-2 gap-6">
                @if($pengaduan->created_at)
                    <div>
                        <p class="text-sm text-gray-500">Dibuat pada</p>
                        <p class="text-sm">{{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                    </div>
                @endif

                @if(isset($pengaduan->user))
                    <div>
                        <p class="text-sm text-gray-500">Dibuat oleh</p>
                        <p class="text-sm">{{ $pengaduan->user->name }}</p>
                    </div>
                @endif
            </div>

            <a href="/instansi" class="mt-6 inline-block bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition duration-200 shadow">
                ⬅️ Kembali ke Dashboard
            </a>
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
