<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buku Favoritku') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @if (session('pesan'))
            <div class="alert alert-success">{{ session('pesan') }}</div>
        @endif

       
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($favorites as $favorite)
                        <tr>
                            <td>{{ $favorite->buku->judul }}</td>
                            <td>{{ $favorite->buku->penulis }}</td>
                            <td>
                                <form action="{{ route('buku.removeFromFavorites', $favorite->buku->id) }}" method="post"
                                    onsubmit="return confirm('Yakin mau dihapus?')">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-semibold hover:text-white py-2 px-2 hover:border-transparent rounded">Hapus dari Daftar Favorit</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada buku favorit</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </div>

</x-app-layout>
