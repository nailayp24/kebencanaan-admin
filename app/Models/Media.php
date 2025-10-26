<?php
// app/Models/Media.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',
        'caption',
        'mime_type',
        'sort_order'
    ];

    public function refTable()
    {
        return $this->morphTo('ref_table', 'ref_table', 'ref_id');
    }
}
