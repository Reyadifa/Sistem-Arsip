<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'peminjam_id',
        'arsip_id',
        'no_ktp',
        'nama_peminjam',
        'alamat_peminjam',
        'nohp_peminjam',
        'keperluan',
        'tgl_minjam',
        'tgl_kembali',
        'status',
        'file_arsip', // Tambahkan ini
    ];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class, 'arsip_id');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjam_id');
    }
}