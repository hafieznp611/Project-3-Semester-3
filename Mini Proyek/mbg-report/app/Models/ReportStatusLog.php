<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportStatusLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['incident_report_id', 'old_status', 'new_status', 'changed_by'];

    protected function casts(): array
    {
        return ['created_at' => 'datetime'];
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
