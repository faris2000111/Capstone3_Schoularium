<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'NIS';
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
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }
}
