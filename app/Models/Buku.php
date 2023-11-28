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
    protected $fillable = ['id', 'judul,', 'penulis', 'harga', 'tgl_terbit', 'created_at', 'updated_at', 'filename', 'filepath',
                            'rating_1', 'rating_2', 'rating_3', 'rating_4', 'rating_5', 'total_ratings', 'rating', 'favorite'];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function photos(){
        return $this->hasMany('App/Buku', 'id_buku', 'id');
    }

    public function calculateRating()
    {
        $a = $this->rating_1;
        $b = $this->rating_2;
        $c = $this->rating_3;
        $d = $this->rating_4;
        $e = $this->rating_5;

        $total = $a + 2 * $b + 3 * $c + 4 * $d + 5 * $e;
        $count = $this->total_ratings;

        $rating = ($count > 0) ? round($total / $count, 2) : null;

        $this->update(['rating' => $rating]);

        return $rating;
    }
}
