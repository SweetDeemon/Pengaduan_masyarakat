<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengaduan</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-950 via-black to-indigo-950 font-inter text-white min-h-screen flex flex-col">

    @include('components.navbar')

    <main class="flex-1 px-4 md:px-0">
        <div class="max-w-4xl mx-auto mt-12 bg-white/5 border border-white/10 backdrop-blur-md p-8 rounded-3xl shadow-xl animate-fadeIn">
            <h1 class="text-3xl font-bold text-cyan-400 mb-6 flex items-center gap-3">
                <i class="fas fa-file-alt text-white text-xl"></i> Detail Pengaduan Saya
            </h1>

            <div class="space-y-6 text-gray-200 text-sm md:text-base">
                <div>
                    <p class="text-gray-400 mb-1">Judul</p>
                    <h2 class="text-xl font-semibold text-white">{{ $pengaduan->judul }}</h2>
                </div>

                <div>
                    <p class="text-gray-400 mb-1">Isi Pengaduan</p>
                    <p class="leading-relaxed">{{ $pengaduan->isi }}</p>
                </div>

                <div>
                    <p class="text-gray-400 mb-1">Status</p>
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-semibold
                        @if($pengaduan->status === 'dikirim') bg-yellow-500/10 text-yellow-400
                        @elseif($pengaduan->status === 'diproses') bg-blue-500/10 text-blue-400
                        @elseif($pengaduan->status === 'selesai') bg-green-500/10 text-green-400
                        @endif
                    ">
                        @if($pengaduan->status === 'selesai')
                            <i class="fas fa-check-circle mr-1"></i>
                        @elseif($pengaduan->status === 'diproses')
                            <i class="fas fa-spinner animate-spin mr-1"></i>
                        @else
                            <i class="fas fa-paper-plane mr-1"></i>
                        @endif
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </div>

                @if($pengaduan->foto)
                    <div>
                        <p class="text-gray-400 mb-2">Foto Bukti</p>
                        <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                             alt="Foto Bukti"
                             class="rounded-xl w-full max-w-md shadow-lg hover:scale-105 transition-transform duration-300">
                    </div>
                @endif

                @if($pengaduan->tanggapan)
                    <div>
                        <p class="text-gray-400 mb-2">Tanggapan Instansi</p>
                        <div class="p-5 bg-cyan-500/10 border-l-4 border-cyan-400 text-cyan-100 rounded-xl shadow">
                            <p class="text-sm">{{ $pengaduan->tanggapan }}</p>
                        </div>
                    </div>
                @endif

                <div>
                    <p class="text-gray-400 mb-1">Tanggal Dibuat</p>
                    <p>{{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="mt-10">
                <a href="{{ url('/dashboard') }}"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-purple-600 text-white px-6 py-2 rounded-xl hover:scale-105 transition-all duration-300 shadow-md">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </main>

    <footer class="mt-auto bg-white/5 border-t border-white/10 py-6 text-center text-sm text-gray-400">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-cyan-400 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-cyan-400 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>

</body>
</html>
