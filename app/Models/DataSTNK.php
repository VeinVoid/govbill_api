<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSTNK extends Model
{
    use HasFactory;

    protected $table = 'data_stnks';

    protected $fillable = [
        'nik',
        'no_rangka',
        'nama_pemilik',
        'merk_kendaraan',
        'nrkb',
        'tanggal_tenggat',
        'bulan_tenggat'
    ];
}
