<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{

    protected $table = 'pemeriksaan';

    protected $fillable = [
        'jam_buka',
        'jam_tutup',
        'tanggal',
        'keterangan',
        'pb_balita',
        'bb_balita',
        'umur',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
