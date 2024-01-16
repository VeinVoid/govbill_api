<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKartu extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kartu',
        'jenis_kartu',
        'bulan_berlaku',
        'tahun_berlaku',
        'cvv',
        'nama_pemilik',
        'saldo',
    ];
}
