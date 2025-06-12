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
<body class="bg-gradient-to-br from-gray-100 to-white min-h-screen font-inter">
    @include('components.navbar')

    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-4xl font-bold text-blue-700 mb-8">📢 Tanggapi Pengaduan</h1>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded mb-6 shadow">
                {{ session('error') }}
            </div>
        @endif

        {{-- Pencarian & Filter --}}
        <form method="GET" class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul pengaduan..."
                class="w-full md:w-1/3 px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select name="status" class="w-full md:w-1/5 px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="dikirim" {{ request('status') === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition">
                🔍 Filter
            </button>
        </form>

        {{-- Daftar Pengaduan --}}
        <div class="space-y-8">
            @forelse ($pengaduans as $pengaduan)
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200 transition hover:shadow-xl hover:scale-[1.01] duration-200">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $pengaduan->judul }}</h2>
                            <span class="inline-block mt-1 text-xs font-medium px-3 py-1 rounded-full
                                @if($pengaduan->status === 'dikirim') bg-yellow-100 text-yellow-800
                                @elseif($pengaduan->status === 'diproses') bg-blue-100 text-blue-800
                                @elseif($pengaduan->status === 'selesai') bg-green-100 text-green-800
                                @endif">
                                {{ ucfirst($pengaduan->status) }}
                            </span>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('instansi.pengaduan.show', $pengaduan->id) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium shadow transition">
                                👁️ Detail
                            </a>

                            @if(in_array($pengaduan->status, ['dikirim', 'diproses']))
                                <a href="{{ route('instansi.pengaduan.edit', $pengaduan->id) }}" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 px-4 py-2 rounded-lg text-sm font-medium shadow transition">
                                    ✏️ Edit
                                </a>
                            @endif
                        </div>
                    </div>

                    <p class="text-gray-700 mb-3">{{ \Illuminate\Support\Str::limit($pengaduan->isi, 150) }}</p>

                    @if($pengaduan->foto)
                        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="w-48 rounded-lg shadow mb-4">
                    @endif

                    @if($pengaduan->status === 'diproses')
                        <form action="/instansi/pengaduan/{{ $pengaduan->id }}/selesai" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition">
                                ✅ Tandai Selesai
                            </button>
                        </form>
                    @endif

                    @if(!$pengaduan->tanggapan && $pengaduan->status !== 'selesai')
                        <form action="/instansi/pengaduan/{{ $pengaduan->id }}" method="POST" class="space-y-3">
                            @csrf
                            <textarea name="tanggapan" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500" placeholder="Tulis tanggapan..." required></textarea>
                            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700 transition">
                                ✉️ Kirim Tanggapan
                            </button>
                        </form>
                    @elseif($pengaduan->tanggapan)
                        <div class="mt-4 p-4 bg-gray-100 rounded-xl text-gray-700">
                            <strong class="text-gray-800">Tanggapan:</strong>
                            <p class="mt-1">{{ $pengaduan->tanggapan }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-600">Belum ada pengaduan yang ditemukan.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $pengaduans->links() }}
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-gray-100 border-t border-gray-200 mt-16 py-6 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>
</body>
</html>
