<?php

namespace App\Services;

use App\Models\IncidentReport;
use Illuminate\Validation\ValidationException;

class ReportWorkflowService
{
    private const TRANSITIONS = [
        'Menunggu' => ['Diproses'],
        'Diproses' => ['Selesai', 'Ditolak'],
        'Selesai'  => [],
        'Ditolak'  => [],
    ];

    public function allowedNext(string $status): array
    {
        return self::TRANSITIONS[$status] ?? [];
    }

    public function review(IncidentReport $report, string $nextStatus, ?string $note): IncidentReport
    {
        if ($nextStatus !== $report->status) {
            $this->ensureValidTransition($report->status, $nextStatus);
        }

        $report->update([
            'status'           => $nextStatus,
            'catatan_reviewer' => $note,
        ]);

        return $report->refresh();
    }

    private function ensureValidTransition(string $from, string $to): void
    {
        if (! in_array($to, $this->allowedNext($from), true)) {
            throw ValidationException::withMessages([
                'status' => "Status tidak boleh berubah dari {$from} ke {$to}.",
            ]);
        }
    }
}