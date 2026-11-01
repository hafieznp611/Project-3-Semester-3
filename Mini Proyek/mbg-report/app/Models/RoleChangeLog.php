<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleChangeLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'old_role', 'new_role', 'changed_by'];

    protected function casts(): array
    {
        return ['created_at' => 'datetime'];
    }
}