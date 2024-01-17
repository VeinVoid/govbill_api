<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBPJS extends Model
{
    use HasFactory;

    protected $table = 'data_bpjs';

    protected $primaryKey = 'id_bpjs';

    protected $fillable = [
        'no_va',
    ];
}
