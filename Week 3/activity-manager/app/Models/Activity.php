<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Activity extends Model
{
     use SoftDeletes;
     
    protected $fillable = [
        'code',
        'start_at',
        'end_at',
        'location',
        'capacity',
        'poster_path',
        'category_id',
        'title',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'date',
            'end_at' => 'date',
        ];
    }

    private const VALID_STATUSES = ['Draft', 'Published', 'Completed'];

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

 return $query->whereHas('category', function ($query) use ($category) {
        $query->where('name', $category);
    });
    }

    public function scopeFilterSearch(Builder $query, ?string $search):Builder{
        
        if(! $search){
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
        });
        
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}

