<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanKendaraan extends Model
{
    use HasFactory;

    protected $table = 'tagihan_kendaraan';

    protected $fillable = [
        'id_stnk',
        'id_alamat',
        'nominal_swdkllj',
        'nominal_pkb',
        'waktu_pembayaran',
        'waktu_tenggat',
    ];

    public function stnk()
    {
        return $this->belongsTo(DataStnk::class, 'id_stnk');
    }
}
