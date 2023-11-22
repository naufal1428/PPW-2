<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use \App\Models\Buku;

use Intervention\Image\Facades\Image;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $totalharga = Buku::sum('harga');
        return view('buku.index', compact('data_buku', 'no', 'jumlah_buku', 'totalharga'));
    }

    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis','like',"%".$cari."%")
        ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        $totalharga = Buku::sum('harga');
        return view('Buku.search', compact('data_buku', 'no','jumlah_buku','totalharga','cari'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'judul' => 'required|string',
        //     'penulis' => 'required|string|max:30',
        //     'harga' => 'required|numeric',
        //     'tgl_terbit' => 'required|date'
        // ]);

        // $buku = new Buku;
        // $buku->judul = $request->judul;
        // $buku->penulis = $request->penulis;
        // $buku->harga = $request->harga;
        // $buku->tgl_terbit = $request->tgl_terbit;
        // $buku->save();
        // return redirect('/buku')->with('pesan','Data Buku Berhasil Disimpan');

        // Validasi input
        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan thumbnail
        $fileNameThumbnail = time() . '_' . $request->thumbnail->getClientOriginalName();
        $filePathThumbnail = $request->file('thumbnail')->storeAs('uploads', $fileNameThumbnail, 'public');

        // Resize dan simpan thumbnail
        Image::make(storage_path() . '/app/public/uploads/' . $fileNameThumbnail)
            ->fit(240, 320)
            ->save();

        // Simpan data buku
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->filename = $fileNameThumbnail;
        $buku->filepath = '/storage/' . $filePathThumbnail;
        $buku->save();

        // Simpan galeri
        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $fileNameGallery = time() . '_' . $file->getClientOriginalName();
                $filePathGallery = $file->storeAs('uploads', $fileNameGallery, 'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileNameGallery,
                    'path' => '/storage/' . $filePathGallery,
                    'foto' => $fileNameGallery,
                    'buku_id' => $buku->id,
                ]);
            }
        }

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $buku = Buku::find($id);
        return view('buku.edit', compact(['buku']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);

        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',

            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);

        if($request->file('thumbnail')) {
            $fileName = time().'-'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(240,320)
                ->save();

            $buku->update([
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath,
            ]);
        };

        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName,'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
            }
        }
        
        return redirect('/buku')->with('pesan','Perubahan Data Buku Berhasil di Simpan');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('buku')->with('pesan','Hapus Buku Berhasil');
    }

    public function deleteImage($buku_id, $image_id) {
        $buku = Buku::find($buku_id);
        $image = Gallery::find($image_id);
    
        if ($image && $buku && $image->buku_id === $buku->id) {
            $image->delete();
            return back()->with('pesan', 'Gambar Berhasil Dihapus');
        } else {
            return back()->with('error', 'Gambar Tidak Ditemukan');
        }
    }

    public function galBuku($title){
        $bukus = Buku::where('buku_seo', $title)->first();
        $galeris = $bukus->photos()->orderBy('id','desc')->paginate(6);
        return view('galeri-buku', compact('$bukus','galeris'));
    }

    public function showGallery($id)
    {
        $buku = Buku::findOrFail($id);
        $galleries = $buku->galleries;

        return view('buku.show_gallery', compact('buku', 'galleries'));
    }

    public function userIndex()
    {
        // $data_buku = Buku::paginate(5); // Sesuaikan dengan cara Anda mendapatkan data buku
        // $jumlah_buku = Buku::count(); // Sesuaikan dengan cara Anda mendapatkan jumlah buku

        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        return view('buku.index_user', compact('data_buku', 'jumlah_buku'));
    }
}
