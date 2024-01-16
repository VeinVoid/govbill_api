<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanTersedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_tagihan_terdaftar',
        'no_tagihan',
        'jenis_tagihan',
        'nama_tagihan',
        'nominal_tagihan',
        'waktu_bayar',
        'waktu_tenggat',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
