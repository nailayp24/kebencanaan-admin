<?php
// app/Models/DistribusiLogistik.php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiLogistik extends Model
{
    use HasFactory;

    protected $table = 'distribusi_logistik';
    protected $primaryKey = 'distribusi_id';

    protected $fillable = [
        'logistik_id',
        'posko_id',
        'tanggal',
        'jumlah',
        'penerima'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
    ];

    // Relationship dengan logistik
    public function logistik()
    {
        return $this->belongsTo(LogistikBencana::class, 'logistik_id', 'logistik_id');
    }

    // Relationship dengan posko
    public function posko()
    {
        return $this->belongsTo(PoskoBencana::class, 'posko_id', 'posko_id');
    }

    // Accessor untuk tanggal format
    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal ? $this->tanggal->format('d/m/Y') : '';
    }

    // Scope untuk Filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope untuk Search
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}
