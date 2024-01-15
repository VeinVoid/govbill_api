<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanPLN extends Model
{
    use HasFactory;

    protected $table = 'tagihan_plns';

    protected $fillable = [
        'id_pln',
        'tagihan',
        'waktu_bisa_bayar',
        'waktu_tenggat',
    ];

    public function pln()
    {
        return $this->belongsTo(DataPln::class, 'id_pln');
    }
}
