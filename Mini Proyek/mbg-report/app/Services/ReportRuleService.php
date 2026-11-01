<?php

namespace App\Services;

use App\Models\IncidentReport;
use Illuminate\Validation\ValidationException;

class ReportRuleService
{
    public function ensureNoDuplicate(int $userId, int $schoolId, string $date, ?int $ignoreId = null): void
    {
        $exists = IncidentReport::query()
            ->where('user_id', $userId)
            ->where('school_id', $schoolId)
            ->whereDate('tanggal_kejadian', $date)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'tanggal_kejadian' => 'Anda sudah membuat laporan untuk sekolah ini pada tanggal tersebut.',
            ]);
        }
    }
}