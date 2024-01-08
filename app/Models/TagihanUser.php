<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanUser extends Model
{
    use HasFactory;

    protected $table = 'tagihan_user';

    protected $fillable = [
        'id_user', 
        'nomor_tagihan', 
        'tipe_tagihan',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
