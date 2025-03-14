<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'email',
        'jabatan',
        'departemen',
        'tanggal_bergabung',
        'foto'
    ];

    protected $dates = [
        'tanggal_lahir',
        'tanggal_bergabung'
    ];

    protected $casts = [
        'tanggal_lahir' => 'datetime',
        'tanggal_bergabung' => 'datetime'
    ];

    public function getRouteKeyName()
    {
        return 'nip';
    }
} 