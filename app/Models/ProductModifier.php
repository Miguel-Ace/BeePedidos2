<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModifier extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'id_producto',
        'modificador',
        'precio2',
        'orden_lista'
    ];
}
