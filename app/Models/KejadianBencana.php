<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KejadianBencana extends Model
{
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
}
