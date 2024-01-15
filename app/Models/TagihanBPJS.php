<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanBPJS extends Model
{
    use HasFactory;

    protected $table = 'tagihan_bpjs';

    protected $fillable = [
        'id_bpjs',
        'no_va',
        'tagihan',
        'waktu_bisa_bayar',
        'waktu_tenggat',
    ];

    public function bpjs()
    {
        return $this->belongsTo(DataBpjs::class, 'id_bpjs');
    }
}
