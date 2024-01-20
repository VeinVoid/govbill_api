<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPLN extends Model
{
    use HasFactory;

    protected $table = 'data_plns';

    protected $fillable = [
        'id_pelanggan',
    ];
}
