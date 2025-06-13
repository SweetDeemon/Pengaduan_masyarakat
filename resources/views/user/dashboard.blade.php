<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        success: '#10B981',
                        proses: '#3B82F6',
                        dikirim: '#F59E0B',
                        softGray: '#f9fafb',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-softGray font-inter min-h-screen flex flex-col">

    @include('components.navbar')

    <main class="flex-grow p-6 max-w-6xl mx-auto w-full">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3 mb-8">
            <i class="fas fa-clock text-blue-600 text-2xl"></i>
            Riwayat Pengaduan Saya
        </h1>

        {{-- Filter dan Search --}}
        <form method="GET" action="{{ route('user.dashboard') }}"
              class="mb-8 flex flex-col md:flex-row md:items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari judul pengaduan..."
                   class="px-4 py-2 w-full md:w-1/2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"/>

            <select name="status"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                <option value="">-- Semua Status --</option>
                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>

            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-all shadow font-medium">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </form>

        {{-- List Pengaduan --}}
        @forelse ($pengaduans as $pengaduan)
            <div class="bg-white p-6 rounded-2xl shadow-md mb-6 border-l-4 transition-all duration-300
                @if($pengaduan->status === 'selesai') border-success
                @elseif($pengaduan->status === 'diproses') border-proses
                @else border-dikirim
                @endif
            ">
                <div class="flex flex-col md:flex-row justify-between gap-4">
                    <div class="flex-1">
                        <h2 class="text-lg md:text-xl font-semibold text-gray-800 hover:text-blue-600 transition">
                            {{ $pengaduan->judul }}
                        </h2>
                        <p class="text-gray-600 mt-2 leading-relaxed">{{ $pengaduan->isi }}</p>

                        @if($pengaduan->foto)
                            <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                                 alt="Foto pengaduan"
                                 class="w-44 mt-4 rounded-lg shadow hover:scale-105 transition-transform duration-300">
                        @endif

                        @if($pengaduan->tanggapan)
                            <div class="mt-5 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg text-blue-800 shadow-inner">
                                <p class="font-semibold mb-1">
                                    <i class="fas fa-comment-dots mr-1"></i> Tanggapan Instansi:
                                </p>
                                <p class="text-sm">{{ $pengaduan->tanggapan }}</p>
                            </div>
                        @endif

                        <a href="{{ route('user.pengaduan.show', $pengaduan->id) }}"
                           class="inline-block mt-4 bg-blue-100 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium shadow-sm hover:bg-blue-200 transition">
                            👁️ Lihat Detail
                        </a>
                    </div>

                    <div class="md:text-right flex md:block items-center justify-between">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($pengaduan->status === 'selesai') bg-success/10 text-success
                            @elseif($pengaduan->status === 'diproses') bg-proses/10 text-proses
                            @else bg-dikirim/10 text-dikirim
                            @endif
                        ">
                            @if($pengaduan->status === 'selesai')
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            @elseif($pengaduan->status === 'diproses')
                                <i class="fas fa-spinner animate-spin mr-1"></i> Diproses
                            @else
                                <i class="fas fa-paper-plane mr-1"></i> Dikirim
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white p-10 rounded-xl text-center shadow-md text-gray-600">
                <i class="fas fa-inbox text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg">Belum ada pengaduan yang kamu buat.</p>
            </div>
        @endforelse

        <div class="mt-8">
            {{ $pengaduans->appends(request()->query())->links() }}
        </div>
    </main>

    <footer class="bg-gray-100 border-t border-gray-200 py-6 text-center text-sm text-gray-500 mt-auto">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>

</body>
</html>
