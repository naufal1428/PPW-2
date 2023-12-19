<!-- resources/views/kategori/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <label for="nama">Nama Kategori:</label>
            <input type="text" id="nama" name="nama" required>
            <button type="submit">Simpan</button>
        </form>
    </div>
</x-app-layout>
