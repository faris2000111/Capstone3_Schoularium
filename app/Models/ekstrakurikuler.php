<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekstrakurikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakurikuler';
    protected $primaryKey = 'id_ekstrakurikuler';
    protected $fillable = [
        'id_ekstrakurikuler', 'nama_ekstrakurikuler', 'id_admin'
    ];
}
