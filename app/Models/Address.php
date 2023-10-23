<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'id_cliente',
        'direccion',
        'coordenadas',
        'favorita'
    ];
}
