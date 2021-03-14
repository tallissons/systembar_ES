<?php

namespace App\Http\Controllers\Portal\Pedido;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('status', 'P')->get();

        $pedidos_S = Pedido::where('status', 'S')->get();
        
        return view('portal.pedido.index', [
            'pedidos' => $pedidos,
            'pedidos_S' => $pedidos_S
        ]);
    }

    public function historico()
    {
        $pedidos = Pedido::where('status', 'F')->orWhere('status', 'C')->orderByDesc('updated_at')->get();
        
        return view('portal.pedido.historico', [
            'pedidos' => $pedidos
        ]);
    }

    public function show($id)
    {
        $pedido = Pedido::where([
            ['id', '=', $id],
            ['status', '<>', "E"],
        ])->first();
        
        if(empty($pedido)){
            return redirect()->route('portal.pedidos');
        }
        
        return view('portal.pedido.show_pedido', [
            'pedido' => $pedido,
        ]);
    }

    public function entregar($id)
    {
        $pedido = Pedido::find($id);

        if(empty($pedido)){
            return redirect()->route('portal.pedidos');
        }

        $pedido->update([
            'status' => "S",
        ]);

        return redirect()->route('portal.pedidos');
    }

    public function finalizar($id)
    {
        $pedido = Pedido::find($id);

        if(empty($pedido)){
            return redirect()->route('portal.pedidos');
        }

        $pedido->update([
            'status' => "F",
        ]);

        return redirect()->route('portal.pedidos');
    }

    public function cancelar($id)
    {
        $pedido = Pedido::find($id);

        if(empty($pedido)){
            return redirect()->route('portal.pedidos');
        }

        $pedido->update([
            'status' => "C",
        ]);

        return redirect()->route('portal.pedidos');
    }
}
