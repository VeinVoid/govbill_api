<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDana extends Model
{
    use HasFactory;

    protected $table = 'payment_dana';

    protected $primaryKey = 'id_dana';

    protected $fillable = [
        'nama', 
        'no_hp',
        'nominal'
    ];
}
