<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Menentukan fillable
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'jurusan',
        'alamat',
        'no_hp',
        'foto'
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('nama', 'like', "%{$value}%")->orWhere('email', 'like', "%{$value}%");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
