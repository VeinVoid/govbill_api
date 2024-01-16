<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_tagihan_tersedia',
        'id_metode_pembayaran',
        'no_pembayaran',
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
