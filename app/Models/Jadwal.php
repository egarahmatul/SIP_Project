<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{

    protected $table = 'jadwal';

    protected $fillable = [
        'jam_buka',
        'jam_tutup',
        'tanggal',
        'keterangan',
        'pb_balita',
        'bb_balita',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
