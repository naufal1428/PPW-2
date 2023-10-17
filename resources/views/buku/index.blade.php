<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<p align="right"><a href="{{ route('buku.create')}}">Tambah Buku</a></p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
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
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('Y-m-d')}}</td>
                    <td>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                            @csrf
                            <button onClick="return confirm('Yakin mau dihapus?')">Hapus</button>
                        </form>

                        <form method="" action="{{ route('buku.edit', $buku->id) }}">
                            @csrf
                            <button>Edit</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <b>Jumlah buku adalah {{ count($data_buku) }}</b>
    <br>
    <b>Total harga semua buku adalah {{ "Rp ".number_format($totalharga, 2, ',', '.') }}</b>
</body>
</html>