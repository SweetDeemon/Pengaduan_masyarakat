<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Detail Pengaduan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-slate-900 text-white font-sans">

    @include('components.navbar')

    <main class="flex-grow px-4">
        <div class="max-w-3xl mx-auto mt-12 bg-slate-800 p-8 rounded-2xl shadow-xl border border-slate-700">
            <h1 class="text-3xl font-bold text-blue-400 mb-6 flex items-center gap-2">
                 Detail Pengaduan
            </h1>

            <div class="space-y-5 text-slate-200">
                <p><span class="font-semibold text-gray-400">Judul:</span> {{ $pengaduan->judul }}</p>
                <p><span class="font-semibold text-gray-400">Isi:</span> {{ $pengaduan->isi }}</p>

                <p>
                    <span class="font-semibold text-gray-400">Status:</span>
                    <span class="inline-block px-3 py-1 text-sm font-medium rounded-full
                        @if($pengaduan->status === 'dikirim') bg-yellow-500/10 text-yellow-400 border border-yellow-400
                        @elseif($pengaduan->status === 'diproses') bg-blue-500/10 text-blue-400 border border-blue-400
                        @elseif($pengaduan->status === 'selesai') bg-green-500/10 text-green-400 border border-green-400
                        @endif">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </p>

                @if($pengaduan->foto)
                    <div>
                        <p class="font-semibold text-gray-400 mb-2">Foto:</p>
                        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan"
                             class="w-full max-w-xs rounded-xl shadow-lg border border-slate-600">
                    </div>
                @endif

                <div class="grid md:grid-cols-2 gap-6">
                    @if($pengaduan->created_at)
                        <div>
                            <p class="text-sm text-gray-400">Dibuat pada</p>
                            <p class="text-sm">{{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    @endif

                    @if(isset($pengaduan->user))
                        <div>
                            <p class="text-sm text-gray-400">Dibuat oleh</p>
                            <p class="text-sm">{{ $pengaduan->user->name }}</p>
                        </div>
                    @endif
                </div>

                <a href="/instansi" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow transition">
                     Kembali ke Dashboard
                </a>
            </div>
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
