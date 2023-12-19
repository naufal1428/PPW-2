<!-- resources/views/buku/buku_populer.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buku Populer') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bukuPopuler as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->ratings->avg('rating') ?? 'Not rated yet' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
