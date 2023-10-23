<?php

namespace App\Models;

use App\Models\User;
use App\Models\Estado;
use App\Models\Empresa;
use App\Models\TipoPago;
use App\Models\TipoPedido;
use App\Models\TipoEntrega;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'num_pedido',
        'fecha_hora',
        'id_cliente',
        'sub_total',
        'descuento',
        'iva',
        'propina',
        'id_tipo_pago',
        'factura_electronica',
        'id_tipo_pedido',
        'id_tipo_entrega',
        'adjuntar_imagen',
        'id_estado',
        'direccion',
        'latitud',
        'longitud',
        'tipo_documento',
        'tiempo_estimado_entrega',
        'tipo',
        'cerrar_pedido'
    ];

    function cliente(){
        return $this->belongsTo(User::class, 'id_cliente');
    }
    function estado(){
        return $this->belongsTo(State::class, 'id_estado');
    }
    function tipoPago(){
        return $this->belongsTo(TypePay::class, 'id_tipo_pago');
    }
    function tipoPedido(){
        return $this->belongsTo(TypeOrder::class, 'id_tipo_pedido');
    }
    function tipoEntrega(){
        return $this->belongsTo(TypeDelivery::class, 'id_tipo_entrega');
    }
}
