<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGopay extends Model
{
    use HasFactory;

    protected $table = 'payment_gopay';

    protected $primaryKey = 'id_gopay';

    protected $fillable = [
        'nama', 
        'no_hp',
        'nominal'
    ];
}
