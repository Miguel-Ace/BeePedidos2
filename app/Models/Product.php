<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'producto',
        'descripcion',
        'precio',
        'descuento',
        'id_categoria',
        'url_imagen',
        'cod_producto_beesy',
        'tipo_producto_beesy',
        'activo',
        'existencia',
    ];
}
