<?php

namespace App\Http\Controllers\Geral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Models\Mesa;

class CarrinhoController extends Controller
{
    public function index()
    {
        $pedido = Pedido::where([
            ['usuario_id', '=', auth()->id()],
            ['status', '=', 'E'], // E editando, P processando, F finalizado, C cancelado
          ])->first();
    //dd($pedido->itensPedido()->get());

        $mesas = Mesa::all();

        return view('geral.pedido.carrinho', [
            'pedido' => $pedido,
            'mesas' => $mesas
        ]);
    }

    public function add(Request $request)
    {
        $last_pedido = Pedido::where([
            ['usuario_id', '=', auth()->id()],
            ['status', '=', 'E'], // E editando, P processando, F finalizado, C cancelado
          ])->first('id');

        //dd($last_pedido);

        if($last_pedido == NULL){
            $pedido = Pedido::create([
            'usuario_id' =>  auth()->id(),
            'status' => 'E', // E editando, P processando, F finalizado, C cancelado
            ]);

            $id_pedido = $pedido->id;
        }
        else {
            $id_pedido = $last_pedido->id;
        }

        $data = $request->all();

        $data['pedido_id'] = $id_pedido;

        ItemPedido::create($data);

        return redirect()->route('carrinho');
    }

    public function remover($id)
    {
        $pedido = Pedido::where([
            ['usuario_id', '=', auth()->id()],
            ['status', '=', 'E'], // E editando, P processando, F finalizado, C cancelado
        ])->first();

        $item_pedido = $pedido->itensPedido()->where([
            'id' => $id,
            'pedido_id' => $pedido->id,
        ])->first();

        if(!empty($item_pedido)){
            $item_pedido->delete();
        }

        return redirect()->route('carrinho');
    }
}
