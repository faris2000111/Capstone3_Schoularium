<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Siswa extends Model implements AuthenticatableContract
{
    use HasFactory, Notifiable, Authenticatable;

    protected $table = 'siswa';
    protected $primaryKey = 'NIS';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'NIS',
        'email',
        'password',
        'nama_siswa',
        'foto',
        'id_kelas',
        'id_ekstrakurikuler'
    ];

    protected $hidden = [
        'password',
    ];

    public function absensi()
    {
        return $this->hasMany(AbsensiSiswa::class, 'NIS', 'NIS');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'id_ekstrakurikuler', 'id_ekstrakurikuler');
    }
}
