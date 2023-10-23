<?php

namespace App\Models;

use App\Models\Producto;
use App\Models\ModificadoresProducto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'num_pedido',
        'id_producto',
        'cantidad',
        'precio',
        'descuento',
        'iva',
        'enviada_beesy',
        'fecha_hora',
        'id_modificador1',
        'id_modificador2',
        'id_modificador3'
    ];

    function producto(){
        return $this->belongsTo(Product::class, 'id_producto');
    }
    function modificadorProducto1(){
        return $this->belongsTo(ProductModifier::class, 'id_modificador1');
    }
    function modificadorProducto2(){
        return $this->belongsTo(ProductModifier::class, 'id_modificador2');
    }
    function modificadorProducto3(){
        return $this->belongsTo(ProductModifier::class, 'id_modificador3');
    }
}
