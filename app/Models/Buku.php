<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    // protected $primaryKey = 'id';
    protected $dates = ['tgl_terbit'];
    protected $fillable = ['id', 'judul,', 'penulis', 'harga', 'tgl_terbit', 'created_at', 'updated_at', 'filename', 'filepath'];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function photos(){
        return $this->hasMany('App/Buku', 'id_buku', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

}
