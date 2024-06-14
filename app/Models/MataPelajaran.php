<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';
    protected $primaryKey = 'id_mata_pelajaran';

    protected $fillable = [
        'nama_pelajaran',
        'id_admin'
    ];

    public function absensi()
    {
        return $this->hasMany(AbsensiSiswa::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_admin');
    }
}
