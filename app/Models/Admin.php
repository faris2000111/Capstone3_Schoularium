<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'admin';
     protected $primaryKey = 'id_admin';
    protected $fillable = [
        'nama',
        'nip',
        'umur',
        'jenis_kelamin',
        'no_telp',
        'email',
        'password',
        'mata_pelajaran',
        'tingkat_pendidikan',
        'foto',
        'jabatan',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

