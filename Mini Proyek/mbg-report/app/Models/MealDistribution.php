<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MealDistribution extends Model
{
    protected $fillable = [
        'sppg_id',
        'school_id',
        'tanggal_distribusi',
        'menu',
        'jumlah_porsi',
        'status',
        'catatan',
    ];

    public function sppg(): BelongsTo
    {
        return $this->belongsTo(Sppg::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function incidentReports(): HasMany
    {
        return $this->hasMany(IncidentReport::class);
    }
}