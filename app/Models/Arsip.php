<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori', 'nama_usaha', 'alamat_usaha', 'nama_pemilik', 'alamat_pemilik', 'npwp', 'bulan', 'tahun', 'file_path',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

}