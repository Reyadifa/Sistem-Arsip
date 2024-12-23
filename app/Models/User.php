<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; 

    protected $primaryKey = 'NIP'; 

    public $incrementing = false; // NIP bukan auto increment

    protected $keyType = 'string'; // NIP menggunakan string

    protected $fillable = [
        'NIP',
        'nama_user',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
