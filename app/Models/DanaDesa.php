<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanaDesa extends Model
{
    use HasFactory;

    protected $table = 'dana_desa';

    protected $fillable = [
        'tahun', 'jumlah', 'penggunaan',
    ];

    public function keuangans()
    {
        return $this->hasMany(Keuangan::class, 'dana_desa_id');
    }
}
