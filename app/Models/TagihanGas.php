<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanGas extends Model
{
    use HasFactory;

    protected $table = 'tagihan_pgn';

    protected $fillable = [
        'id_pgn',
        'tagihan',
        'waktu_pembayaran',
        'waktu_tenggat',
    ];

    public function gas()
    {
        return $this->belongsTo(DataGas::class, 'id_pgn');
    }
}
