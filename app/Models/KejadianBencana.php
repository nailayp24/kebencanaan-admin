<?php
// app/Models/KejadianBencana.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianBencana extends Model
{
    use HasFactory;

    protected $table = 'kejadian_bencana';
    protected $primaryKey = 'kejadian_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'jenis_bencana', 'tanggal', 'lokasi_text', 'rt', 'rw',
        'dampak', 'status_kejadian', 'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal ? $this->tanggal->format('d/m/Y') : '';
    }

    public function posko()
    {
        return $this->hasMany(PoskoBencana::class, 'kejadian_id');
    }

    //  RELASI DONASI
    public function donasi()
    {
        return $this->hasMany(DonasiBencana::class, 'kejadian_id');
    }

    // Total donasi untuk kejadian ini
    public function getTotalDonasiAttribute()
    {
        return $this->donasi()->sum('nilai');
    }

    public function getTotalDonasiFormattedAttribute()
    {
        $total = $this->total_donasi;
        return $total ? 'Rp ' . number_format($total, 0, ',', '.') : 'Rp 0';
    }
}
