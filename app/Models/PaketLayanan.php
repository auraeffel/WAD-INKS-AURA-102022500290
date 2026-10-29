<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketLayanan extends Model
{
    protected $table = 'paket_layanan';
    protected $fillable = ['nama_paket', 'jenis', 'harga', 'estimasi_jam', 'deskripsi'];
}