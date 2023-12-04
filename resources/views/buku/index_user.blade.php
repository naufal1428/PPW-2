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
                    <th>Rating</th>
                    <th>Favorite</th>
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
                        <td>
                            {{ $buku->judul }}
                            <div>
                                @if ($buku->ratings->isEmpty())
                                   <p class="text-red-600"> Rating is not available </p>
                                @else
                                   <p class="text-green-600"> Rating: {{ number_format($buku->ratings->avg('rating'), 2) }} </p>
                                @endif
                            </div>
                        </td>
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
                        <td>
                            @if(Auth::check())
                                <form action="{{ route('user.rateBook', $buku->id) }}" method="post">
                                    @csrf
                                    <select name="rating" id="rating" class="border rounded w-full py-2 px-3">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <button type="submit" class="text-blue-600">Submit Rating</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if (auth()->user()->favorites->contains('buku_id', $buku->id))
                                <form action="{{ route('buku.removeFromFavorites', $buku->id) }}" method="post"
                                    onsubmit="return confirm('Yakin mau dihapus?')">
                                    @csrf
                                    <button type="submit" class=" text-red-500 font-semibold hover:text-red-700 py-2 px-2 ">Hapus</button>
                                </form>
                            @else
                                <form action="{{ route('buku.addToFavorites', $buku->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class=" text-blue-500 font-semibold hover:text-blue-700 py-2 px-2 ">Simpan</button>
                                </form>
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
