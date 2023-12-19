<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MencobaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/fnatic', [MencobaController::class, 'fnaticesport']);

Route::get('/fpx', [MencobaController::class, 'fpxesport']);

// Route::get('/', [MencobaController::class, 'beranda']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/detail-buku/{title}',[BukuController::class, 'galbuku'])->name('galeri.buku');

    Route::get('/buku/show-gallery/{id}', [BukuController::class, 'showGallery'])->name('user.showGallery');

    Route::get('/buku/user-index', [BukuController::class, 'userIndex'])->name('user.index');

    Route::post('/buku/rate/{id}', [BukuController::class, 'rateBook'])->name('user.rateBook');

    Route::post('/buku/{id}/add-to-favorites', [BukuController::class, 'addToFavorites'])->name('buku.addToFavorites');

    Route::post('/buku/{id}/remove-from-favorites', [BukuController::class, 'removeFromFavorites'])->name('buku.removeFromFavorites');

    Route::get('/buku/myfavorites', [BukuController::class, 'myFavorites'])->name('buku.myFavorites');

    Route::get('/buku-populer', [BukuController::class, 'bukuPopuler'])->name('buku.populer');

    Route::resource('kategori', KategoriController::class);

    Route::middleware('admin')->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/buku', [BukuController::class, 'index'])->name('buku');

        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');

        Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');

        Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');

        Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');

        Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

        Route::post('/buku/edit/{id}/delete-image/{image_id}', [BukuController::class, 'deleteImage'])->name('buku.deleteImage');


        Route::resource('kategori', KategoriController::class);

    });
});


require __DIR__.'/auth.php';