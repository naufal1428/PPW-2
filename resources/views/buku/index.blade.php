{{-- @extends('layout.master')

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
        <div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div> --}}
    
        {{-- <b>Jumlah buku adalah {{ count($data_buku) }}</b> --}}
        {{-- <br>
        <b>Total harga semua buku adalah {{ "Rp ".number_format($totalharga, 2, ',', '.') }}</b> --}}

    {{-- </div>
    
@endsection --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Buku') }}
        </h2>
    </x-slot>

    <div class="container">
        @if (session('pesan'))
            <div class="alert alert-success">{{ session('pesan') }}</div>
        @endif
    
        <form action="{{ route('buku.search') }}" method="GET" class="search-form">
            @csrf
            <input type="text" name="kata" class="form-control" placeholder="Cari...">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    
        <p><a href="{{ route('buku.create') }}" class="btn btn-success">Tambah Buku</a></p>
    
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
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp " . number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post"
                                onsubmit="return confirm('Yakin mau dihapus?')">
                                @csrf
                                
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn-edit">Edit</a>
                        </div>
                    </td>
                </tr>                
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data buku</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    
        <div class="pagination">
            {{ $data_buku->links() }}
        </div>
        <div class="mt-3"><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>
    </div>
    
    <style>
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
    
        .search-form {
            margin-bottom: 20px;
        }
    
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
    
        .table th, .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    
        .btn {
            padding: 8px 16px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    
        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }
    
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
    
        .btn-success {
            background-color: #28a745;
            color: #fff;
        }
    
        .pagination {
            text-align: center;
        }
    
        .pagination ul {
            display: inline-block;
            padding: 0;
            margin: 0;
        }
    
        .pagination li {
            display: inline;
            margin-right: 10px;
        }
    
        .pagination li:last-child {
            margin-right: 0;
        }
    
        .pagination a {
            text-decoration: none;
            color: #007bff;
        }
    
        .pagination .active a {
            font-weight: bold;
        }

        .action-buttons {
            display: flex;
        }

        .btn-delete, .btn-edit {
            padding: 8px 16px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-edit {
            background-color: #007bff;
        }

    </style>
    

</x-app-layout>
