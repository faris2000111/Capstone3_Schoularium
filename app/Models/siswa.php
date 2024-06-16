<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $primaryKey = "id_siswa";
    protected $fillable = [
        'NIS', 'email', 'password', 'nama_siswa', 'id_kelas', 'ekstrakurikuler', 'foto', 'id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
