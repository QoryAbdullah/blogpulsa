<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pulsa extends Model
{
    use HasFactory;
    protected $table = 'pulsa';

    protected $fillable = [
        'id_provider',
        'gambar',
        'jenis_pulsa',     
        'harga'
    ];

    public function provider() {
        return $this->belongsTo('App\Models\Provider', 'id_provider');
    }
}
