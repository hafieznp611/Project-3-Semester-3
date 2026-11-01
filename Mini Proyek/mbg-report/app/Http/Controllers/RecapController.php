<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Models\School;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'school_id' => ['nullable', 'exists:schools,id'],
            'status'    => ['nullable', 'in:menunggu,diproses,selesai,ditolak'],
        ]);

        // ringkasan (kartu): ikut filter sekolah dan status
        $base = IncidentReport::query()
            ->when($request->school_id, fn ($q, $id) => $q->where('school_id', $id))
            ->when($request->status, fn ($q, $s) => $q->where('status', $s));

        $ringkasan = [
            'total'    => (clone $base)->count(),
            'menunggu' => (clone $base)->where('status', 'menunggu')->count(),
            'diproses' => (clone $base)->where('status', 'diproses')->count(),
            'selesai'  => (clone $base)->where('status', 'selesai')->count(),
        ];

        // tabel rekap per sekolah
        $perSekolah = School::query()
            ->when($request->school_id, fn ($q, $id) => $q->where('id', $id))
            ->withCount([
                'incidentReports as total'    => fn ($q) => $q,
                'incidentReports as menunggu' => fn ($q) => $q->where('status', 'menunggu'),
                'incidentReports as diproses' => fn ($q) => $q->where('status', 'diproses'),
                'incidentReports as selesai'  => fn ($q) => $q->where('status', 'selesai'),
            ])
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('rekap.index', [
            'ringkasan'  => $ringkasan,
            'perSekolah' => $perSekolah,
            'schools'    => School::orderBy('nama')->get(),
        ]);
    }
}