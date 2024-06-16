<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'NIS',
        'email',
        'password',
        'nama_siswa',
        'jenis_kelamin',
        'foto',
        'id_kelas',
        'id_ekstrakurikuler'
    ];
    public function kelas(){
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }
    public function ekstrakurikuler(){
        return $this->hasOne('App\models\ekstrakurikuler', 'id_ekstrakurikuler', 'id_ekstrakurikuler');
    }
}
