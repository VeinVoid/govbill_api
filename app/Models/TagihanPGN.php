<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanPGN extends Model
{
    use HasFactory;

    protected $table = 'tagihan_pgns';

    protected $fillable = [
        'id_pgn',
        'tagihan',
        'waktu_bisa_bayar',
        'waktu_tenggat',
    ];

    public function gas()
    {
        return $this->belongsTo(DataPGN::class, 'id_pgn');
    }
}
