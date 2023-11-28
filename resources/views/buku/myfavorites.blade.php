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
                </tr>
            </thead>
            <tbody>
                @forelse($favorites as $favorite)
                    <tr>
                        <td>{{ $favorite->judul }}</td>
                        <td>{{ $favorite->penulis }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Tidak ada buku favorit</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
