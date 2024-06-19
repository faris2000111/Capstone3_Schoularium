<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = "jadwal_pelajaran";
    protected $primaryKey = "id_jadwal";
    protected $fillable = [
        'id_mata_pelajaran', 'id_admin', 'id_kelas', 'hari', 'lama_jam', 'jam_mulai', 'jam_selesai'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}