<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffProfile extends Model
{
    use HasFactory;

    protected $table = 'staff_profiles';

    protected $fillable = [
        'user_id', 'nama', 'foto', 'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
