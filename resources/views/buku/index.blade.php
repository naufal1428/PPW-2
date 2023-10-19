@extends('layout.master')

@section('content')

    @if (Session::has('pesan'))
        <div class="alert alert-success">{{Session::get('pesan')}}</div>
    @endif

    <div class="container">

        <form action="{{ route('buku.search') }}" method="GET">@csrf
            <input type="text" name="kata" class="form-control" placeholder="Cari..."
            style="width: 30%; display:inline; margin-top: 10px; margin-bottom: 10px; float: right;">
        </form>
    
        <p><a href="{{ route('buku.create')}}">Tambah Buku</a></p>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tgl. Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <td>{{ ++$no}}</td>
                        <td>{{ $buku->judul}}</td>
                        <td>{{ $buku->penulis}}</td>
                        <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.')}}</td>
                        <td>{{ $buku->tgl_terbit->format('d/m/Y')}}</td>
                        <td>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                @csrf
                                <button class="btn btn-danger" onClick="return confirm('Yakin mau dihapus?')">Hapus</button>
                            </form>
                            <br>
                            <form method="" action="{{ route('buku.edit', $buku->id) }}">
                                @csrf
                                <button class="btn btn-primary">Edit</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div class="row">{{ $data_buku->links() }}</div>
        <div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>
    
        {{-- <b>Jumlah buku adalah {{ count($data_buku) }}</b> --}}
        {{-- <br>
        <b>Total harga semua buku adalah {{ "Rp ".number_format($totalharga, 2, ',', '.') }}</b> --}}

    </div>
    
@endsection
