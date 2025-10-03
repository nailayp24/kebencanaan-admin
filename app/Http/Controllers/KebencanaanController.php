<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KebencanaanController extends Controller
{
    public function index()
    {
        $kejadian = [
            [
                'kejadian_id'   => 1,
                'jenis_bencana' => 'Banjir',
                'tanggal'       => '2025-09-20',
                'lokasi_text'   => 'Jl. Melati No. 10',
                'rt'            => '01',
                'rw'            => '05',
                'dampak'        => '20 rumah terendam',
                'status'        => 'Dalam Penanganan',
                'keterangan'    => 'Bantuan logistik sedang disalurkan'
            ],
            [
                'kejadian_id'   => 2,
                'jenis_bencana' => 'Kebakaran',
                'tanggal'       => '2025-09-22',
                'lokasi_text'   => 'Pasar Raya',
                'rt'            => '03',
                'rw'            => '02',
                'dampak'        => '5 kios terbakar',
                'status'        => 'Selesai',
                'keterangan'    => 'Api berhasil dipadamkan'
            ],
        ];

        return view('kebencanaan.index', compact('kejadian'));
    }
}
