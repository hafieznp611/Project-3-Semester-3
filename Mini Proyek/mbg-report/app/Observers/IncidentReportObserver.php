<?php

namespace App\Observers;

use App\Models\IncidentReport;

class IncidentReportObserver
{
    /**
     * Handle the IncidentReport "created" event.
     */
    public function created(IncidentReport $incidentReport): void
    {
        //
    }

    /**
     * Handle the IncidentReport "updated" event.
     */
    public function updated(IncidentReport $incidentReport): void
    {
        //
    }

    /**
     * Handle the IncidentReport "deleted" event.
     */
    public function deleted(IncidentReport $incidentReport): void
    {
        //
    }

    /**
     * Handle the IncidentReport "restored" event.
     */
    public function restored(IncidentReport $incidentReport): void
    {
        //
    }

    /**
     * Handle the IncidentReport "force deleted" event.
     */
    public function forceDeleted(IncidentReport $incidentReport): void
    {
        //
    }
}
