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
        'nama_peminjam',
        'keperluan',
        'tgl_minjam',
        'tgl_kembali',
        'status',
        'file_arsip',
        'nohp',
        'surat_kuasa',
        
    ];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class);
    }

    public function usaha()
    {
        return $this->belongsTo(Usaha::class);
    }
}
