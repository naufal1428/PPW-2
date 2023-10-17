<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    
    <div class="container">
        <h4>Edit Buku</h4>
        <form method="post" action="{{ route('buku.update', $buku->id) }}">
            @csrf
            <div>Judul <input type="text" name="judul" value="{{$buku->judul}}"></div>
            <div>Penulis <input type="text" name="penulis" value="{{$buku->penulis}}"></div>
            <div>Harga <input type="text" name="harga" value="{{ $buku->harga}}"></div>
            <div>Tgl. Terbit <input type="text" name="tgl_terbit" value="{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('Y-m-d')}}"></div>
            <div><button type="submit">Update</button>
            <a href="/buku">Batal</a></div>
        </form>
    </div>
    
</body>
</html>