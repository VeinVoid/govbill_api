<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanPDAM extends Model
{
    use HasFactory;

    protected $table = 'tagihan_pdams';

    protected $fillable = [
        'id_pdam',
        'tagihan',
        'waktu_bisa_bayar',
        'waktu_tenggat',
    ];

    public function pdam()
    {
        return $this->belongsTo(DataPdam::class, 'id_pdam');
    }
}
