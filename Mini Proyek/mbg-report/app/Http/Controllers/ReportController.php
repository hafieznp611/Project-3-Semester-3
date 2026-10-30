<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\School;  
use App\Models\IncidentReport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reports = $request->user()
            ->report()
            ->with('school')
            ->latest()
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create', [
            'schools' => School::orderBy('nama')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'school_id'        => ['required', 'exists:schools,id'],
            'judul'            => ['required', 'string', 'max:255'],
            'tanggal_kejadian' => ['required', 'date', 'before_or_equal:today'],
            'deskripsi'        => ['required', 'string', 'min:10'],
            'foto'             => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('reports', 'public');
        }

        $data['user_id'] = $request->user()->id;
        $data['status']  = 'menunggu';

        IncidentReport::create($data);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Laporan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
   public function show(Request $request, string $id): View
    {
        $report = $request->user()
            ->report()
            ->with('school')
            ->findOrFail($id);

        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
}
