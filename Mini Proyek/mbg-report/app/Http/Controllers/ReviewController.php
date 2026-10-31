<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReviewReportRequest;
use App\Services\ReportWorkFlowService;


class ReviewController extends Controller
{
    public function edit(string $id, ReportWorkflowService $workflow)
    {
        $report = IncidentReport::with(['school.sppg', 'user'])->findOrFail($id);

        return view('review.edit', compact('report'));
    }

    public function update(ReviewReportRequest $request, string $id, ReportWorkflowService $workflow)
    {
        $report = IncidentReport::findOrFail($id);
        $data = $request->validated();

        $workflow->review($report, $data['status'], $data['catatan'] ?? null);

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'Status laporan diperbarui.');
    }
}