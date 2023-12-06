<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePay extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'tipo_pago',
        'cod_tipo_pago_beesy'
    ];
}
