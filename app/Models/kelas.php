<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
     protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'nama_kelas',
        'id_admin',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'nama_kelas'
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(AbsensiSiswa::class, 'id_kelas', 'id_kelas');
    }

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'id_kelas', 'id_kelas');
    }
}
