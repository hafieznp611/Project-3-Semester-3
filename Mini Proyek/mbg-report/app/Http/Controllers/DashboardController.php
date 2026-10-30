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

        $data = ['user' => $user];

        if ($user->role === 'complainant') {
            $data['reports'] = $user->report()
                ->with('school')
                ->latest()
                ->paginate(5);
       
                
        } else {
            // admin / reviewer: semua laporan + statistik
            $data['reports'] = IncidentReport::with(['school', 'user'])
                ->latest()
                ->paginate(5);


            $data['total']    = IncidentReport::count();
            $data['menunggu'] = IncidentReport::where('status', 'menunggu')->count();
            $data['selesai']  = IncidentReport::where('status', 'selesai')->count();
        }

        return view('dashboard.dashboard', $data);
    }
}