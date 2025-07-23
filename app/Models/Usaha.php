<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_usaha',
        'alamat_usaha',
        'npwp',
        'nama_pemilik',
        'alamat_pemilik',
    ];

    public function arsips()
    {
        return $this->hasMany(Arsip::class);
    }
}
