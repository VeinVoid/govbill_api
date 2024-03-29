<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 
        'jenis',
        'nama', 
        'nomor', 
        'saldo',
        'pembayaran_utama'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
