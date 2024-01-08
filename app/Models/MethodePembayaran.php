<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'methode_pembayaran';

    protected $fillable = [
        'id_user', 
        'nama', 
        'nomor', 
        'nominal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
