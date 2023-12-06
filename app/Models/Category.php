<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'icon_categoria',
        'categoria',
        'cod_tipo_producto_beesy'
    ];
}
