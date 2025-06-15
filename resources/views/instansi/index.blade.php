<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Instansi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-b from-[#0f172a] to-[#1e293b] text-white min-h-screen font-inter flex flex-col">

    @include('components.navbar')

    <div class="max-w-6xl mx-auto px-6 py-10 flex-grow">
        <h1 class="text-4xl font-bold mb-8 text-white">📢 Tanggapi Pengaduan</h1>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="bg-green-600/20 border border-green-400 text-green-300 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-600/20 border border-red-400 text-red-300 p-4 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Pencarian & Filter --}}
        <form method="GET" action="{{ route('user.dashboard') }}"
              class="mb-8 flex flex-col md:flex-row md:items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari judul pengaduan..."
                   class="px-4 py-2 w-full md:w-1/2 bg-white/10 border border-white/20 text-white rounded-lg placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-500"/>

            <select name="status"
                    class="px-4 py-2 bg-white/100 border border-white/20 text-black rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="">-- Semua Status --</option>
                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>

            <button type="submit"
                    class="bg-gradient-to-r from-cyan-500 to-purple-600 text-white px-5 py-2 rounded-lg hover:scale-105 transition shadow font-medium">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>

        {{-- Daftar Pengaduan --}}
        <div class="space-y-8">
            @forelse ($pengaduans as $pengaduan)
                <div class="bg-white/5 border border-white/10 p-6 rounded-2xl shadow-md backdrop-blur-sm transition hover:shadow-xl hover:scale-[1.01] duration-200">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
                        <div>
                            <h2 class="text-2xl font-semibold text-white">{{ $pengaduan->judul }}</h2>
                            <span class="inline-block mt-1 text-xs font-medium px-3 py-1 rounded-full
                                @if($pengaduan->status === 'dikirim') bg-yellow-400/20 text-yellow-300
                                @elseif($pengaduan->status === 'diproses') bg-blue-400/20 text-blue-300
                                @elseif($pengaduan->status === 'selesai') bg-green-400/20 text-green-300
                                @endif">
                                {{ ucfirst($pengaduan->status) }}
                            </span>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('instansi.pengaduan.show', $pengaduan->id) }}"
                               class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                 Detail
                            </a>

                            @if($pengaduan->status === 'dikirim')
                                <a href="{{ route('instansi.pengaduan.edit', $pengaduan->id) }}"
                                   class="bg-yellow-500/20 hover:bg-yellow-500/30 text-yellow-300 px-4 py-2 rounded-lg text-sm font-medium transition">
                                     Edit
                                </a>
                            @endif
                        </div>
                    </div>

                    <p class="text-gray-300 mb-3">{{ \Illuminate\Support\Str::limit($pengaduan->isi, 150) }}</p>

                    @if($pengaduan->foto)
                        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="w-48 rounded-lg shadow mb-4">
                    @endif

                    @if($pengaduan->status === 'diproses')
                        <form action="/instansi/pengaduan/{{ $pengaduan->id }}/selesai" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2 rounded-xl hover:opacity-90 transition font-semibold">
                                ✅ Tandai Selesai
                            </button>
                        </form>
                    @endif

                    @if(!$pengaduan->tanggapan && $pengaduan->status !== 'selesai')
                        <form action="/instansi/pengaduan/{{ $pengaduan->id }}" method="POST" class="space-y-3">
                            @csrf
                            <textarea name="tanggapan" class="w-full p-4 bg-white/10 text-white border border-white/20 rounded-xl focus:ring-2 focus:ring-green-500 placeholder-gray-400" placeholder="📝 Tulis tanggapan..." required></textarea>
                            <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2 rounded-xl hover:opacity-90 transition font-semibold">
                                ✉️ Kirim Tanggapan
                            </button>
                        </form>
                    @elseif($pengaduan->tanggapan)
                        <div class="mt-4 p-4 bg-white/10 border border-white/10 rounded-xl text-gray-300">
                            <strong class="text-white">Tanggapan:</strong>
                            <p class="mt-1">{{ $pengaduan->tanggapan }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-400 text-center">Belum ada pengaduan yang ditemukan.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $pengaduans->links('pagination::tailwind') }}
        </div>
    </div>

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
