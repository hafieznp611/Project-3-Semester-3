<?php

namespace App\Models;
use App\Models\IncidentReport;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'username',
        'password',
        'role',
        'no_hp',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function report(): HasMany
    {
        return $this->hasMany(IncidentReport::class);
    }
}