<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\School;  
use App\Models\IncidentReport;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $statuses = ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'];

        $search = trim((string) $request->query('q', ''));
        $status = in_array($request->query('status'), $statuses, true)
            ? $request->query('status')
            : '';

        $base = $user->role === 'complainant'
            ? $user->report()
            : IncidentReport::query();

        $reports = $base
            ->with('school')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                    ->orWhereHas('user', fn ($s) => $s->where('nama_lengkap', 'like', "%{$search}%"));
                });
            })
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $data = [
            'user'           => $user,
            'reports'        => $reports,
            'statuses'       => $statuses,
            'search'         => $search,
            'selectedStatus' => $status,
        ];

        if ($user->role !== 'complainant') {
            $data['total']    = IncidentReport::count();
            $data['menunggu'] = IncidentReport::where('status', 'Menunggu')->count();
            $data['selesai']  = IncidentReport::where('status', 'Selesai')->count();
        }

        return view('dashboard.dashboard', $data);
    }
}