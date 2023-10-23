<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'url_imagen',
        'descripcion',
        'cedula',
        'pais',
        'empresa',
        'direccion',
        'telefono',
        'email',
        'celular',
        'coordenadas',
        'cantidad_pedidos',
        'tipo_licencia',
        'tiempo_preparacion',
        'moneda',
    ];
}
