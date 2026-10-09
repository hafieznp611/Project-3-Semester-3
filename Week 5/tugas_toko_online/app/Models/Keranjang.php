<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = null;     // primary key gabungan, tidak ada satu kolom id
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id_user', 'id_barang', 'jumlah'];
}