<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sppg extends Model
{
    protected $fillable = ['nama', 'alamat', 'penanggung_jawab', 'kontak_penanggung_jawab'];

    public function mealDistributions(): HasMany
    {
        return $this->hasMany(MealDistribution::class);
    }

    public function schools(): HasMany
{
    return $this->hasMany(School::class);
}
}