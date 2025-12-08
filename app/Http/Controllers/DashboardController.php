<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use App\Models\DonasiBencana;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('auth.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // **Auth::user() - SESUAI CONTOH MATERI**
        // Dapatkan user yang sedang login
        $currentUser = Auth::user();

        // Hitung statistik
        $totalWarga = Warga::count();
        $totalKejadian = KejadianBencana::count();
        $totalPosko = PoskoBencana::count();
        $totalDonasi = DonasiBencana::count();
        $totalUsers = User::count();

        // Hitung kejadian berdasarkan status
        $kejadianDilaporkan = KejadianBencana::where('status_kejadian', 'dilaporkan')->count();
        $kejadianDiverifikasi = KejadianBencana::where('status_kejadian', 'diverifikasi')->count();
        $kejadianDitangani = KejadianBencana::where('status_kejadian', 'ditangani')->count();
        $kejadianSelesai = KejadianBencana::where('status_kejadian', 'selesai')->count();

        // Ambil kejadian terbaru (5 data terbaru)
        $kejadianTerbaru = KejadianBencana::with('donasi')
            ->latest()
            ->take(5)
            ->get();

        // Ambil warga terbaru
        $wargaTerbaru = Warga::latest()->take(5)->get();

        // Hitung total nilai donasi
        $totalNilaiDonasi = DonasiBencana::sum('nilai');

        // Data untuk chart (opsional)
        $chartData = [
            'labels' => ['Warga', 'Kejadian', 'Posko', 'Donasi', 'Users'],
            'data' => [$totalWarga, $totalKejadian, $totalPosko, $totalDonasi, $totalUsers]
        ];

        // Status kejadian untuk chart
        $statusKejadianData = [
            'labels' => ['Dilaporkan', 'Diverifikasi', 'Ditangani', 'Selesai'],
            'data' => [$kejadianDilaporkan, $kejadianDiverifikasi, $kejadianDitangani, $kejadianSelesai],
            'colors' => ['#6c757d', '#17a2b8', '#ffc107', '#28a745']
        ];

        return view('pages.dashboard', compact(
            'totalWarga',
            'totalKejadian',
            'totalPosko',
            'totalDonasi',
            'totalUsers',
            'totalNilaiDonasi',
            'kejadianTerbaru',
            'wargaTerbaru',
            'kejadianDilaporkan',
            'kejadianDiverifikasi',
            'kejadianDitangani',
            'kejadianSelesai',
            'chartData',
            'statusKejadianData',
            'currentUser'
        ));
    }
}
