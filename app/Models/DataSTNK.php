<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSTNK extends Model
{
    use HasFactory;

    protected $table = 'data_stnk';

    protected $primaryKey = 'id_stnk';

    protected $fillable = [
        'no_reg',
        'nama_pemilik',
        'nrkb',
    ];
}
