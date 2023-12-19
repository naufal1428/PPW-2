<!-- resources/views/kategori/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="nama">Nama Kategori:</label>
            <input type="text" id="nama" name="nama" value="{{ $kategori->nama }}" required>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</x-app-layout>
