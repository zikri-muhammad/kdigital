<?php

namespace App;
use App\Kategori_produk;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    public function kategori()
    {
        return $this->belongsTo(Kategori_produk::class);
    }
}
