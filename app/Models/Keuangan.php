<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 'keuangan';

    protected $fillable = [
        'jumlah', 'tanggal', 'sumber', 'tujuan', 'total', 'keterangan', 'user_id', 'dana_desa_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function danaDesa()
    {
        return $this->belongsTo(DanaDesa::class, 'dana_desa_id');
    }
}
