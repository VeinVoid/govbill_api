<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPBB extends Model
{
    use HasFactory;

    protected $table = 'data_pbbs';

    // protected $primaryKey = 'id_data_pbb';

    protected $fillable = [
        'nop',
        'nama_pemilik',
        'kota_kabupaten',
    ];
}
