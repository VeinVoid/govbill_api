<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nama_penerima',
        'no_hp',
        'label_alamat',
        'alamat_lengkap',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
