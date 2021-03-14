<?php

namespace App\Http\Controllers\Geral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\CategoriaProduto;

class CardapioController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProduto::all();
        $produtos = Produto::whereNull('categoria_id')->get();

        return view('geral.home', [
            'categorias' => $categorias,
            'produtos' => $produtos
        ]);
    }
}
