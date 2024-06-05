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
        'NIS', 'email', 'password', 'nama_siswa', 'jenis_kelamin', 'id_kelas', 'id_ekstrakurikuler', 'foto', 'id_siswa'
    ];

    public function kelas(){
        return $this->hasOne('App\models\kelas', 'id_kelas', 'id_kelas');
    }
    public function ekstrakurikuler(){
        return $this->hasOne('App\models\ekstrakurikuler', 'id_ekstrakurikuler', 'id_ekstrakurikuler');
    }
}
