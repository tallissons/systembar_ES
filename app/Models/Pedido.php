<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'status',
    ];

    public function itensPedido(){
        return $this->hasMany('App\Models\ItemPedido', 'pedido_id', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function detalheEntrega()
    {
        return $this->hasOne('App\Models\DetalhesEntrega');
    }
}
