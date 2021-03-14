<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public $timestamps = false;

    public function produtos()
    {
        return $this->hasMany('App\Models\Produto', 'categoria_id', 'id');
    }
}
