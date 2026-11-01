<?php

namespace App\Observers;

use App\Models\IncidentReport;
use App\Models\ReportStatusLog;

class IncidentReportObserver
{
    /**
     * Catat perubahan status laporan.
     */
    public function updated(IncidentReport $report): void
    {
        if (! $report->wasChanged('status')) {
            return;
        }

        ReportStatusLog::create([
            'incident_report_id' => $report->id,
            'old_status'         => $report->getOriginal('status'),
            'new_status'         => $report->status,
            'changed_by'         => auth()->id(),
        ]);
    }
}