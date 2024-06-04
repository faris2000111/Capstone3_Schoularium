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
        'NIS', 'email', 'password', 'nama_siswa', 'kelas', 'ekstrakurikuler', 'foto'
    ];
}
