<?php

namespace App\Http\Controllers;

use App\Models\Sppg;
use Illuminate\Http\Request;

class SppgController extends Controller
{
    public function index()
    {
        return view('recap.sppgs.index', [
            'sppgs' => Sppg::withCount('schools')->orderBy('nama')->paginate(5)
        ]);
    }

    public function create()
    {
        return view('recap.sppgs.form', ['sppg' => new Sppg()]);
    }

    public function store(Request $request)
    {
        Sppg::create($this->validated($request));

        return redirect()->route('sppgs.index')->with('success', 'SPPG berhasil ditambahkan.');
    }

    public function edit(Sppg $sppg)
    {
        return view('recap.sppgs.form', [
            'sppg' => $sppg,
            'sppgs'  => Sppg::orderBy('nama')->get(),
        ]);;
    }

    public function update(Request $request, Sppg $sppg)
    {
        $sppg->update($this->validated($request));

        return redirect()->route('sppgs.index')->with('success', 'SPPG berhasil diperbarui.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama'                    => ['required', 'string', 'max:255'],
            'alamat'                  => ['nullable', 'string', 'max:255'],
            'penanggung_jawab'        => ['nullable', 'string', 'max:255'],
            'kontak_penanggung_jawab' => ['nullable', 'string', 'max:20'],
        ]);
    }
}