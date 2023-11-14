<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>
    
    {{-- <div class="container mt-5">

        @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="post" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" value="{{$buku->judul}}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input type="text" class="form-control" name="penulis" value="{{$buku->penulis}}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="text" class="form-control" name="harga" value="{{ $buku->harga}}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tgl. Terbit</label>
                <input type="text" id="tgl_terbit" name="tgl_terbit" class="date form-control" value="{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('Y/m/d')}}">
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Gambar</label>
                <input type="file" name="thumbnail" value="{{$buku->filepath}}">
            </div>

            <div><button type="submit" class="btn btn-success">Update</button>
                <a href="/buku">Batal</a></div>

            <div class="col-span-full mt-6">
                <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper">

                </div>
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah</a>
                <script type="text/javascript">
                    function addFileInput () {
                        var div = document.getElementById('fileinput_wrapper');
                        div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                    };
                </script>
            </div>

            
            <div class="gallery_items">
                @foreach($buku->galleries()->get() as $gallery)
                    <div class="gallery_item">
                        <img
                        class="rounded-full object-cover object-center"
                        src="{{ asset($gallery->path) }}"
                        alt=""
                        width="400"
                        />
                    </div>
                @endforeach
            </div>
             
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>

        </form>

    </div> --}}

    {{-- <div class="container mt-5">

        @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="post" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" value="{{$buku->judul}}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input type="text" class="form-control" name="penulis" value="{{$buku->penulis}}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="text" class="form-control" name="harga" value="{{ $buku->harga}}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tgl. Terbit</label>
                <input type="text" id="tgl_terbit" name="tgl_terbit" class="date form-control" value="{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('Y/m/d')}}">
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Gambar</label>
                <input type="file" name="thumbnail" value="{{$buku->filepath}}">
            </div>

            <div class="col-span-full mt-6">
                <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper">

                </div>
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah</a>
                <script type="text/javascript">
                    function addFileInput () {
                        var div = document.getElementById('fileinput_wrapper');
                        div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                    };
                </script>
            </div>

            
            <div class="gallery_items">
                @foreach($buku->galleries()->get() as $gallery)
                    <div class="gallery_item">
                        <img
                        class="rounded-full object-cover object-center"
                        src="{{ asset($gallery->path) }}"
                        alt=""
                        width="400"
                        />
                    </div>
                @endforeach
            </div>
             
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/buku" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>

        </form>

    </div> --}}

    <div class="container mt-5">

        @if (session('pesan'))
            <div class="alert alert-success">{{ session('pesan') }}</div>
        @endif

        @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    
        <form method="post" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data" class="mt-4">
            @csrf
    
            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-600">Judul</label>
                <input type="text" id="judul" name="judul" class="form-input mt-1 block w-full rounded-md" value="{{ $buku->judul }}">
            </div>
    
            <div class="mb-4">
                <label for="penulis" class="block text-sm font-medium text-gray-600">Penulis</label>
                <input type="text" id="penulis" name="penulis" class="form-input mt-1 block w-full rounded-md " value="{{ $buku->penulis }}">
            </div>
    
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-600">Harga</label>
                <input type="text" id="harga" name="harga" class="form-input mt-1 block w-full rounded-md" value="{{ $buku->harga }}">
            </div>
    
            <div class="mb-4">
                <label for="tgl_terbit" class="block text-sm font-medium text-gray-600">Tgl. Terbit</label>
                <input type="text" id="tgl_terbit" name="tgl_terbit" class="form-input mt-1 block w-full rounded-md" value="{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('Y/m/d') }}">
            </div>
    
            <div class="mb-4">
                <label for="thumbnail" class="block text-sm font-medium text-gray-600">Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-input mt-1 block w-full rounded-md">
            </div>
    
            <div class="col-span-full mt-6">
                <label for="gallery" class="block text-sm font-medium text-gray-600">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper"></div>
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="text-blue-600 hover:underline">Tambah</a>
                <script type="text/javascript">
                    function addFileInput() {
                        var div = document.getElementById('fileinput_wrapper');
                        div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="form-input block w-full rounded-md mb-5" style="margin-bottom:5px;">';
                    };
                </script>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-6">
                <a href="/buku" class="text-sm font-semibold text-red-500 hover:underline">Cancel</a>
                <button type="submit" class="px-3 py-3 text-sm text-blue-700 font-semibold hover:underline">Save</button>
            </div>
    
        </form>
    
        {{-- gallery --}}
        <div class="gallery_items mt-6 space-x-4 flex flex-wrap">
            @foreach($buku->galleries()->get() as $gallery)
                <div class="gallery_item mb-4">
                    <img class="object-cover object-center" src="{{ asset($gallery->path) }}" alt="" width="400">
                    <form action="{{ route('buku.deleteImage', [$buku->id, $gallery->id]) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger mt-1 mb-1" onClick="return confirm('Yakin mau dihapus?')">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    

</x-app-layout>