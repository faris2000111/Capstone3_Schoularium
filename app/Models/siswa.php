<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'id_ekstrakurikuler',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    // Tambahan relasi dengan kelas dan ekstrakurikuler jika diperlukan
}
