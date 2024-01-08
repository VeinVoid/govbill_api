<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanBumiDanBangunan extends Model
{
    use HasFactory;

    protected $table = 'tagihan_pbb';

    protected $fillable = [
        'id_pbb',
        'tagihan',
        'waktu_pembayaran',
        'waktu_tenggat',
    ];

    public function bumiBangunan()
    {
        return $this->belongsTo(DataBumiBangunan::class, 'id_pbb');
    }
}
