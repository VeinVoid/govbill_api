<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user'; 

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'email',
        'phone_number',
        'password',
        'profile_picture',
    ];

    protected $guard = [
        'password',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
