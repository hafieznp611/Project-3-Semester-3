<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'nama',
        'kecamatan',
        'judul',
        'tanggal_kejadian',
        'foto',
        'status',
    ];

    public function school() { return $this->belongsTo(School::class); }
}