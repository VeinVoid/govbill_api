<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTagihan extends Model
{
    use HasFactory;

    protected $table = 'history_tagihan';

    protected $fillable = [
        'id_user',
        'nama_tagihan',
        'status',
        'total',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
