<?php

namespace App\Http\Controllers;

use App\Models\KejadianBencana;

class DashboardController extends Controller
{
    public function index()
    {
        $kejadian = KejadianBencana::latest()->get();

        $totalKejadian = KejadianBencana::count();
        $dalamPenanganan = KejadianBencana::where('status', 'Dalam Penanganan')->count();
        $selesai = KejadianBencana::where('status', 'Selesai')->count();

        return view('dashboard.index', compact(
            'kejadian',
            'totalKejadian',
            'dalamPenanganan',
            'selesai'
        ));
    }
}
