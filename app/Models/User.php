<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Menentukan nama tabel jika bukan konvensi Laravel
    protected $table = 'users'; 

    // Menentukan primary key
    protected $primaryKey = 'id_user'; 

    // Menentukan apakah primary key adalah auto-increment
    public $incrementing = true; 

    // Menentukan tipe data primary key
    protected $keyType = 'int'; 

    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}