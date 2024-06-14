<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiSiswa extends Model
{
    use HasFactory;

    protected $table = 'absensi_siswa';

    protected $fillable = [
        'id_admin',
        'NIS',
        'tanggal',
        'status_kehadiran',
        'alasan_ketidakhadiran',
        'id_kelas',
        'id_mata_pelajaran',
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS', 'NIS');
    }
}
