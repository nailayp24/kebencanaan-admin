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
     
        return view('pages.dashboard');
    }
};
