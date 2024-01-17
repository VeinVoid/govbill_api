<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $table = 'users'; 

    // protected $primaryKey = 'id';

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

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'id_user');
    }

    public function tagihanTerdaftar()
    {
        return $this->hasMany(TagihanTerdaftar::class, 'id_user');
    }

    public function tagihanTersedia()
    {
        return $this->hasMany(TagihanTersedia::class, 'id_user');
    }

    public function metodePembayaran()
    {
        return $this->hasMany(MetodePembayaran::class, 'id_user');
    }

    public function historyTagihan()
    {
        return $this->hasMany(HistoryTagihan::class, 'id_user');
    }
}
