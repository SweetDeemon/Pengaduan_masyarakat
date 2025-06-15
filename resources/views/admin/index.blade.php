<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        dikirim: '#f59e0b',
                        diproses: '#3b82f6',
                        selesai: '#10b981',
                        dark: '#0f172a'
                    }
                }
            }
        };
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-dark text-white font-inter">
    @include('components.navbar')

    <main class="flex-grow">
        <div class="p-6 max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-white mb-6 flex items-center gap-2">
                <i class="fas fa-clipboard-list text-cyan-400"></i> Daftar Pengaduan Masyarakat
            </h1>

            {{-- Filter & Pencarian --}}
            <form method="GET" class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul pengaduan..."
                    class="w-full md:w-1/3 px-4 py-2 border border-white/20 bg-white/10 text-white rounded-lg placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-500">

            <select name="status"
                    class="px-4 py-2 bg-white/100 border border-white/20 text-black rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="">-- Semua Status --</option>
                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>

                <button type="submit"
                    class="bg-gradient-to-r from-cyan-500 to-purple-600 text-white px-5 py-2 rounded-lg hover:scale-105 transition shadow font-semibold">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
            </form>

            {{-- Tabel Pengaduan --}}
            <div class="overflow-x-auto rounded-xl shadow-md bg-white/5 border border-white/10 backdrop-blur-sm">
                <table class="min-w-full table-auto text-sm text-left">
                    <thead class="bg-white/10 text-gray-300 uppercase tracking-wider">
                        <tr>
                            <th class="p-4">Judul</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengaduans as $pengaduan)
                            <tr class="border-b border-white/10 hover:bg-white/5 transition">
                                <td class="p-4 font-medium text-white">{{ $pengaduan->judul }}</td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($pengaduan->status === 'dikirim') bg-dikirim/20 text-dikirim
                                        @elseif($pengaduan->status === 'diproses') bg-diproses/20 text-diproses
                                        @elseif($pengaduan->status === 'selesai') bg-selesai/20 text-selesai
                                        @endif
                                    ">
                                        @if($pengaduan->status === 'dikirim')
                                            <i class="fas fa-paper-plane mr-1"></i> Dikirim
                                        @elseif($pengaduan->status === 'diproses')
                                            <i class="fas fa-spinner animate-spin mr-1"></i> Diproses
                                        @else
                                            <i class="fas fa-check-circle mr-1"></i> Selesai
                                        @endif
                                    </span>
                                </td>
                                <td class="p-4 space-x-2">
                                    <a href="/admin/pengaduan/{{ $pengaduan->id }}" class="text-cyan-400 hover:underline font-semibold">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </a>

                                    <a href="/admin/pengaduan/{{ $pengaduan->id }}/edit" class="text-yellow-400 hover:underline font-semibold">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>

                                    <form method="POST" action="/admin/pengaduan/{{ $pengaduan->id }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus pengaduan ini?')" class="text-red-500 hover:underline font-semibold">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-400 p-6">
                                    <i class="fas fa-inbox text-2xl mb-2"></i><br>
                                    Tidak ada pengaduan ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6 text-white">
                {{ $pengaduans->links() }}
            </div>
        </div>
    </main>

    <footer class="bg-white/10 border-t border-white/20 py-6 text-center text-sm text-gray-400">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-cyan-400 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-cyan-400 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>
</body>
</html>
