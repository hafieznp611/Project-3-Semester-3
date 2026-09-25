<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'activity_date',
        'category',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
        ];
    }

    private const VALID_STATUSES = ['Planned', 'Ongoing', 'Done'];


    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        if (! $status || ! in_array($status, self::VALID_STATUSES, true)) {
            return $query;
        }

        return $query->where('status', $status);
    }


    public function scopeFilterCategory(Builder $query, ?string $category): Builder
    {
        if (! $category) {
            return $query;
        }

        return $query->where('category', $category);
    }
}