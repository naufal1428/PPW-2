@extends('layout.master')

@section('content')
    
    <div class="container">

        <h4 align="center">Edit Buku</h4>

        @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="post" action="{{ route('buku.update', $buku->id) }}">
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

            <div><button type="submit" class="btn btn-success">Update</button>
            <a href="/buku">Batal</a></div>
        </form>
    </div>

@endsection
    
