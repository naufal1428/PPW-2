@extends('layout.master')

@section('content')

    @if (Session::has('pesan'))
        <div class="alert alert-success">{{Session::get('pesan')}}</div>
    @endif

    @if (count($data_buku))
        <div class="alert alert-success">Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan
        kata: <strong>{{ $cari }}</strong></div>

        <div class="container mt-5">
            @if (session('pesan'))
                <div class="alert alert-success">{{ session('pesan') }}</div>
            @endif
        
            <form action="{{ route('buku.search') }}" method="GET" class="form-inline my-2">
                @csrf
                <div class="input-group">
                    <input type="text" name="kata" class="form-control" placeholder="Cari..."
                        style="width: 70%;">
                    <div class="input-group-append">
                        <button class="btn btn-warning mx-3" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        
            @if(Auth::user()->level=='admin')
                <p><a href="{{ route('buku.create') }}" class="btn btn-success my-3">Tambah Buku</a></p>
            @endif
    
            <div class="container">
                <table class="table">
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
                        @forelse($data_buku as $buku)
                            <tr class="table-secondary">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ "Rp " . number_format($buku->harga, 2, ',', '.') }}</td>
                                <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                                <td class="d-flex">
                                    @if(Auth::user()->level=='admin')
                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="post"
                                        onsubmit="return confirm('Yakin mau dihapus?')">
                                        @csrf
                                        
                                        <button type="submit" class="btn btn-danger mr-3">Hapus</button>
                                    </form>
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data buku</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        
            <div class="row justify-content-center">
                {{ $data_buku->links() }}
            </div>
            <div class="mt-3"><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>

            {{-- <b>Jumlah buku adalah {{ count($data_buku) }}</b> --}}
            {{-- <br>
            <b>Total harga semua buku adalah {{ "Rp ".number_format($totalharga, 2, ',', '.') }}</b> --}}

        </div>

    @else
        <div class="alert alert-warning"><h4>Data {{ $cari }} tidak ditemukan</h4>
        <a href="/buku" class="btn btn-warning">Kembali</a></div>
    @endif

    
@endsection
