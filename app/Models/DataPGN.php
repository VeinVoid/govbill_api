<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGas extends Model
{
    use HasFactory;

    protected $table = 'data_pgn';

    protected $primaryKey = 'id_pgn';

    protected $fillable = [
        'no_pelanggan',
        'nama_pelanggan',
    ];
}
