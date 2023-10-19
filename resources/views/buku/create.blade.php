@extends('layout.master')

@section('content')

<div class="container">
    <h4 align="center">Tambah Buku</h4>

    @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('buku.store') }}">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul">
          </div>
        
        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" class="form-control" name="penulis">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="text" class="form-control" name="harga">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tgl. Terbit</label>
            <input type="text" id="tgl_terbit" name="tgl_terbit" class="date form-control" placeholder="yyyy/mm/dd">
        </div>
        
        <div><button type="submit" class="btn btn-success">Simpan</button>
        <a href="/buku">Batal</a></div>
    </form>
</div>
    
@endsection
