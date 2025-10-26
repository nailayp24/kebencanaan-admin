<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\KejadianBencana;
use App\Models\PoskoBencana;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik
        $totalWarga = Warga::count();
        $totalKejadian = KejadianBencana::count();
        $totalPosko = PoskoBencana::count();
        $totalUser = User::count();

        // Ambil kejadian terbaru
        $kejadianTerbaru = KejadianBencana::orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        // Kirim data ke view menggunakan compact
        return view('admin.dashboard', compact(
            'totalWarga',
            'totalKejadian',
            'totalPosko',
            'totalUser',
            'kejadianTerbaru'
        ));
    }
};
