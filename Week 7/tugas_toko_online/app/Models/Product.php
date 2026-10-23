<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_barang';
    public $incrementing = false;   // id berupa teks, bukan auto increment
    protected $keyType = 'string';
    public $timestamps = false;     // tabel tidak punya created_at/updated_at

    protected $fillable = ['id_barang', 'nama_barang', 'deskripsi', 'harga', 'stok', 'gambar'];
}