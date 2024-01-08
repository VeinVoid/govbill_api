<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataNIK extends Model
{
    use HasFactory;

    protected $table = 'data_nik';

    protected $primaryKey = 'id_nik';

    protected $fillable = [
        'no_nik',
        'nama',
        'tanggal_lahir',
    ];
}
