<?php
// app/Models/DonasiBencana.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiBencana extends Model
{
    use HasFactory;

    protected $table = 'donasi_bencana';
    protected $primaryKey = 'donasi_id';

    protected $fillable = [
        'kejadian_id', 'donatur_nama', 'jenis', 'nilai', 'keterangan'
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
    ];

    public function kejadianBencana()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }

    // Accessor untuk format nilai
    public function getNilaiFormattedAttribute()
    {
        return $this->nilai ? 'Rp ' . number_format($this->nilai, 0, ',', '.') : '-';
    }

    // Accessor untuk jenis donasi
    public function getJenisDonasiAttribute()
    {
        $jenis = [
            'uang' => 'Uang',
            'barang' => 'Barang',
            'jasa' => 'Jasa'
        ];

        return $jenis[$this->jenis] ?? $this->jenis;
    }
}
