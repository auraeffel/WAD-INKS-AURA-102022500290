<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    protected $table = 'mesins';

    protected $fillable = [
        'nama_mesin', 'jenis', 'kapasitas_kg',
        'status', 'perawatan_terakhir', 'catatan',
    ];

    protected $casts = [
        'perawatan_terakhir' => 'date',
    ];

    public const JENIS = [
        'mesin_cuci' => 'Mesin Cuci',
        'pengering'  => 'Pengering',
        'setrika'    => 'Setrika',
        'lainnya'    => 'Peralatan Lain',
    ];

    public const STATUS = [
        'tersedia'  => 'Tersedia',
        'digunakan' => 'Sedang Digunakan',
        'perawatan' => 'Perawatan',
        'rusak'     => 'Rusak',
    ];
}
