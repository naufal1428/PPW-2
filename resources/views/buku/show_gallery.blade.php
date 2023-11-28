<!-- show_gallery.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Galeri Buku - ' . $buku->judul) }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h3>Galeri Buku - {{ $buku->judul }}</h3>

        <div class="gallery_items mt-6 space-x-4 flex flex-wrap">
            @foreach($galleries as $gallery)
                <div class="gallery_item mb-4">
                    <a href="{{ asset($gallery->path) }}" data-lightbox="roadtrip"><img class="object-cover object-center" src="{{ asset($gallery->path) }}" alt="" width="400"></a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
