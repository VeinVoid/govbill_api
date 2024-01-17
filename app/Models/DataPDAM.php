<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPDAM extends Model
{
    use HasFactory;

    protected $table = 'data_pdam';

    protected $primaryKey = 'id_pdam';

    protected $fillable = [
        'no_pelanggan',
        'kota_kabupaten',
    ];
}
