<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPLN extends Model
{
    use HasFactory;

    protected $table = 'data_pln';

    protected $primaryKey = 'id_pln';

    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
    ];
}
