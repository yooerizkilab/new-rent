<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'id_user',
        'id_item',
        'nama_user',
        'no_tlpn_user',
        'nama_item',
        'jenis_item',
        'lokasi',
        'proyek',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id');
    }
}
