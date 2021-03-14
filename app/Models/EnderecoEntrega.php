<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoEntrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrega_id',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'cep',
        'complemento',
    ];

    public $timestamps = false;

    public $incrementing = false;

    public function detalheEntrega()
    {
        return $this->belongsTo('App\Models\DetalhesEntrega', 'entrega_id');
    }
}
