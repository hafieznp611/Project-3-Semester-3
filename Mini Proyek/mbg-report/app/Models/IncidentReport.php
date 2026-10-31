<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentReport extends Model
{
    protected $fillable = [
        'user_id', 'school_id', 'meal_distribution_id',
        'judul', 'deskripsi', 'tanggal_kejadian', 'foto', 'status',
        'catatan_reviewer',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mealDistribution(): BelongsTo
    {
        return $this->belongsTo(MealDistribution::class);
    }
}