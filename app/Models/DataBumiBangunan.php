<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBumiBangunan extends Model
{
    use HasFactory;

    protected $table = 'data_bumi_bangunan';

    protected $primaryKey = 'id_bumi_bangunan';

    protected $fillable = [
        'nop',
        'nama_pemilik',
        'provinsi',
        'kota',
    ];
}
