<?php
// app/Models/Warga.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email'
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'ref_table', 'ref_table', 'ref_id', 'warga_id');
    }
}
