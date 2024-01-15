<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanPBB extends Model
{
    use HasFactory;

    protected $table = 'tagihan_pbbs';

    protected $fillable = [
        'id_pbb',
        'tagihan',
        'waktu_bisa_bayar',
        'waktu_tenggat',
    ];

    public function bumiBangunan()
    {
        return $this->belongsTo(DataPBB::class, 'id_pbb');
    }
}
