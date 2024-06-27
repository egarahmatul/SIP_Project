<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{

    protected $table = 'balita';

    protected $fillable = [
        'nama_balita',
        'usia_balita',
        'jenis_kelamin_balita',
        'tanggal_lahir_balita',
        'tempat_lahir_balita',
        'id_users',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
