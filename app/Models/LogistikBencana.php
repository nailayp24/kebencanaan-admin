<?php
// app/Models/LogistikBencana.php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogistikBencana extends Model
{
    use HasFactory;

    protected $table = 'logistik_bencana';
    protected $primaryKey = 'logistik_id';

    protected $fillable = [
        'kejadian_id',
        'nama_barang',
        'satuan',
        'stok',
        'sumber'
    ];

    protected $casts = [
        'stok' => 'integer',
    ];

    // Relationship dengan kejadian bencana
    public function kejadianBencana()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }

    // Relationship dengan distribusi logistik
    public function distribusi()
    {
        return $this->hasMany(DistribusiLogistik::class, 'logistik_id', 'logistik_id');
    }

    // Total stok yang sudah didistribusikan
    public function getStokTersediaAttribute()
    {
        $distribusi = $this->distribusi()->sum('jumlah');
        return $this->stok - $distribusi;
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
