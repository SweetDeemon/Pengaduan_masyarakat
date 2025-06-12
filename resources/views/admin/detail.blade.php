<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pengaduan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-slate-100 to-white min-h-screen font-sans">
    @include('components.navbar')

    <div class="max-w-3xl mx-auto mt-14 bg-white p-8 rounded-3xl shadow-lg border border-gray-100 animate-fade-in">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fa-solid fa-file-alt text-indigo-600"></i>
                Detail Pengaduan
            </h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap mengenai laporan masyarakat</p>
        </div>

        <div class="space-y-6 text-gray-800">
            <div>
                <p class="text-sm text-gray-500">Judul Pengaduan</p>
                <h2 class="text-xl font-semibold">{{ $pengaduan->judul }}</h2>
            </div>

            <div>
                <p class="text-sm text-gray-500">Isi Pengaduan</p>
                <p class="bg-gray-50 p-4 rounded-xl border border-gray-200">{{ $pengaduan->isi }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="inline-block px-4 py-1 rounded-full text-sm font-medium
                    @if($pengaduan->status === 'dikirim')
                        bg-yellow-100 text-yellow-800
                    @elseif($pengaduan->status === 'diproses')
                        bg-blue-100 text-blue-800
                    @elseif($pengaduan->status === 'selesai')
                        bg-green-100 text-green-800
                    @else
                        bg-gray-100 text-gray-800
                    @endif
                ">
                    {{ ucfirst($pengaduan->status) }}
                </span>
            </div>

            @if($pengaduan->foto)
                <div>
                    <p class="text-sm text-gray-500 mb-2">Foto Bukti</p>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Bukti"
                        class="rounded-xl w-full max-w-md shadow-md hover:scale-105 transition-transform duration-300 ease-in-out">
                </div>
            @endif

            @if($pengaduan->tanggapan)
                <div>
                    <p class="text-sm text-gray-500">Tanggapan Instansi</p>
                    <div class="p-4 bg-indigo-50 rounded-xl border border-indigo-200 text-indigo-800">
                        {{ $pengaduan->tanggapan }}
                    </div>
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
        </div>

        <div class="mt-10">
            <a href="/admin"
                class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl hover:bg-indigo-700 transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

<footer class="bg-gray-100 border-t border-gray-200 py-6 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>
</body>
</html>
