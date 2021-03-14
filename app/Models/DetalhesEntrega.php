<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalhesEntrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'mesa',
        'tipo',
        'pagamento'
    ];

    public $timestamps = false;

    public function pedido()
    {
        return $this->belongsTo('App\Models\Pedido', 'pedido_id');
    }

    public function enderecoEntrega()
    {
        return $this->hasOne('App\Models\EnderecoEntrega', 'entrega_id');
    }

}
