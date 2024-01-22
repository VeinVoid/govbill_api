<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPGN extends Model
{
    use HasFactory;

    protected $table = 'data_pgns';

    protected $primaryKey = 'id_pgn';

    protected $fillable = [
        'no_pelanggan',
    ];
}
