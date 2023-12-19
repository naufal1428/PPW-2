<!-- resources/views/kategori/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kategori') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @foreach($kategoris as $kategori)
            {{ $kategori->nama }}
            <br>
        @endforeach
    </div>
</x-app-layout>
