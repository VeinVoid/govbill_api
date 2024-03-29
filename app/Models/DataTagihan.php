<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_tagihan',
        'no_tagihan',
        'nominal_tagihan',
        'waktu_bisa_bayar',
        'waktu_tenggat',
        'status',
    ];
}
