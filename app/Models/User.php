<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_user'; 

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'phone_number',
        'image',
        'token'
    ];

    protected $guard = [
        'password',
        'token'
    ];

    protected $hidden = [
        'password'
    ];
}
