<?php

namespace App;
use App\Produk;

use Illuminate\Database\Eloquent\Model;

class Kategori_produk extends Model
{
    public function produk()
    {
        return $this->hasOne(Produk::class);
    }
}
