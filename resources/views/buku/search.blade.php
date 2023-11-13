<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Buku') }}
        </h2>
    </x-slot>

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
        
            <form action="{{ route('buku.search') }}" method="GET" class="flex my-2">
                @csrf
                <div class="flex items-center">
                    <input type="text" name="kata" class="form-input w-3/4 rounded-md mr-2" placeholder="Cari...">
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-semibold hover:text-white py-2 px-4 mr-3 hover:border-transparent rounded" type="submit">Cari</button>
                </div>
            </form>
        
            @if(Auth::user()->level=='admin')
                <p><a href="{{ route('buku.create') }}" class="btn btn-success my-3">Tambah Buku</a></p>
            @endif
        
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
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
                            <td>
                                @if ($buku->filepath)
                                    <div class="relative h-10 w-10">
                                        <img
                                            class="h-full w-full rounded-full object-cover object-center"
                                            src="{{ asset($buku->filepath) }}"
                                            alt="Thumbnail"
                                        />
                                    </div>
                                @endif
                            </td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ "Rp " . number_format($buku->harga, 2, ',', '.') }}</td>
                            <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                            <td class="flex">
                                @if(Auth::user()->level=='admin')
                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="post"
                                        onsubmit="return confirm('Yakin mau dihapus?')">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-semibold hover:text-white py-2 px-4 mr-3 hover:border-transparent rounded">Hapus</button>
                                    </form>
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold hover:text-white py-2 px-4 mr-3 hover:border-transparent rounded">Edit</a>
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
        
            <div class="flex justify-center">
                {{ $data_buku->links() }}
            </div>
            <div class="mt-3"><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>

        </div>

    @else
        <div class="alert alert-warning"><h4>Data {{ $cari }} tidak ditemukan</h4>
        <a href="/buku" class="btn btn-warning">Kembali</a></div>
    @endif

    
</x-app-layout>