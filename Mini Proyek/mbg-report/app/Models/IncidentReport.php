<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    protected $fillable = [
        'user_id', 'school_id', 'meal_distribution_id',
        'judul', 'deskripsi', 'tanggal_kejadian', 'foto', 'status',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mealDistribution()
    {
        return $this->belongsTo(mealDistribution::class);
    }
}
