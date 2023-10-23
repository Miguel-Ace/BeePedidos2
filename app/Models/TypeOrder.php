<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOrder extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = ['tipo_pedido'];
}
