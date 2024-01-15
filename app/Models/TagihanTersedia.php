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
        'nominal_bayar',
        'waktu_bayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tagihanTerdaftar()
    {
        return $this->belongsTo(TagihanTerdaftar::class, 'id_tagihan_terdaftar');
    }
}
