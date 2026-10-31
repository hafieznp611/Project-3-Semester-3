<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Sppg;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        return view('recap.schools.index', [
            'schools' => School::with('sppg')->orderBy('nama')->paginate(5),
        ]);
    }

    public function create()
    {
        return view('recap.schools.form', [
            'school' => new School(),
            'sppgs'  => Sppg::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        School::create($this->validated($request));

        return redirect()
            ->route('schools.index')
            ->with('success', 'Sekolah berhasil ditambahkan.');
    }

    public function edit(School $school)
    {
        return view('recap.schools.form', [
            'school' => $school,
            'sppgs'  => Sppg::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, School $school)
    {
        $school->update($this->validated($request));

        return redirect()
            ->route('schools.index')
            ->with('success', 'Sekolah berhasil diperbarui.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama'      => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:50'],
            'sppg_id'   => ['nullable', 'exists:sppgs,id'],
        ]);
    }
}