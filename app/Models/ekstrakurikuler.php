<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';
    protected $primaryKey = 'id_ekstrakurikuler';

    protected $fillable = [
        'nama_ekstrakurikuler',
        'id_admin'
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_ekstrakurikuler', 'id_ekstrakurikuler');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
