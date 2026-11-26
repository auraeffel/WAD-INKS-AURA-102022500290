<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanPembersih extends Model
{
    protected $table = 'bahan_pembersihs';

    protected $fillable = [
        'nama_bahan', 'jenis', 'stok', 'satuan',
        'stok_minimum', 'harga_satuan', 'catatan',
    ];

    public const JENIS = [
        'deterjen'  => 'Deterjen',
        'pelembut'  => 'Pelembut',
        'pewangi'   => 'Pewangi',
        'pemutih'   => 'Pemutih',
        'lainnya'   => 'Lainnya',
    ];

    public const SATUAN = [
        'liter' => 'Liter',
        'kg'    => 'Kg',
        'pcs'   => 'Pcs',
        'botol' => 'Botol',
    ];

    public function getIsMenipisAttribute(): bool
    {
        return $this->stok <= $this->stok_minimum;
    }
}
