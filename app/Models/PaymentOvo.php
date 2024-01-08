<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOvo extends Model
{
    use HasFactory;

    protected $table = 'payment_ovo';

    protected $primaryKey = 'id_ovo';

    protected $fillable = [
        'nama', 
        'no_hp', 
        'nominal'
    ];
}
