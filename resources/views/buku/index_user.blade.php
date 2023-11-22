<!-- index_user.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Buku') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @if (session('pesan'))
            <div class="alert alert-success">{{ session('pesan') }}</div>
        @endif
    
        <table class="table w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Thumbnail</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tgl. Terbit</th>
                    <th>Galeri</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data_buku as $buku)
                    <tr class="table-secondary">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($buku->filepath)
                                <div class="relative h-10 w-10">
                                    <img
                                        class="h-full w-full rounded-full object-cover object-center"
                                        src="{{ asset($buku->filepath) }}"
                                        alt="Thumbnail"
                                    />
                                </div>
                            @endif
                        </td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp " . number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                        <td>
                            @if ($buku->galleries->isNotEmpty())
                                <a href="{{ route('user.showGallery', $buku->id) }}" class="underline text-blue-600">Lihat Galeri</a>
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data buku</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    
        <div class="flex justify-center">
            {{ $data_buku->links() }}
        </div>
        <div class="mt-3"><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>
    </div>
</x-app-layout>
