<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorite';

    protected $fillable = ['user_id', 'buku_id'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
