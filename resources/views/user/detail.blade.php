<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengaduan</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-inter min-h-screen flex flex-col">

    @include('components.navbar')

    <main class="flex-1">
        <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-xl">
            <h1 class="text-3xl font-bold text-blue-700 mb-6">📄 Detail Pengaduan Saya</h1>

            <div class="space-y-5 text-gray-800">
                <div>
                    <p class="text-sm text-gray-500">Judul</p>
                    <h2 class="text-xl font-semibold">{{ $pengaduan->judul }}</h2>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Isi Pengaduan</p>
                    <p class="text-base">{{ $pengaduan->isi }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                        @if($pengaduan->status === 'dikirim') bg-yellow-100 text-yellow-700
                        @elseif($pengaduan->status === 'diproses') bg-blue-100 text-blue-700
                        @elseif($pengaduan->status === 'selesai') bg-green-100 text-green-700
                        @endif
                    ">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </div>

                @if($pengaduan->foto)
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Foto Bukti</p>
                        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Bukti" class="rounded-xl w-full max-w-md shadow-md">
                    </div>
                @endif

                @if($pengaduan->tanggapan)
                    <div>
                        <p class="text-sm text-gray-500">Tanggapan Instansi</p>
                        <div class="p-4 bg-gray-100 rounded-xl border text-gray-700">
                            {{ $pengaduan->tanggapan }}
                        </div>
                    </div>
                @endif

                <div>
                    <p class="text-sm text-gray-500">Tanggal Dibuat</p>
                    <p class="text-sm">{{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ url('/dashboard') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
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
