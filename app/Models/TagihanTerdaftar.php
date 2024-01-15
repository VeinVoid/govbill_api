<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanTerdaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'no_tagihan',
        'nama_tagihan',
        'jenis_tagihan',
        'tanggal_bayar',
        'bulan_bayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
