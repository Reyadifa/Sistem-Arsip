<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori'; // Custom primary key

    protected $fillable = ['nama_kategori'];

    public function arsips()
    {
        return $this->hasMany(Arsip::class, 'id_kategori');
    }
}