<?php

namespace App\Http\Controllers\Geral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function detalhesPedido(Request $request)
    {
        $last_pedido = Pedido::where([
            ['usuario_id', '=', auth()->id()],
            ['status', '=', 'E'], // E editando, P processando, S saiu para entrega, F finalizado, C cancelado
        ])->first();

        if(empty($last_pedido)){
            return redirect()->back();
        }

        $data = $request->all();

        if($data['tipo'] == "D"){ //Delivery
            $detalheEntrega = $last_pedido->detalheEntrega()->create([
                'tipo' => $data['tipo'],
                'pagamento' => $data['pagamento'],
            ]);

            $detalheEntrega->enderecoEntrega()->create([
                'rua' => $data['rua'],
                'numero' => $data['numero'],
                'bairro' => $data['bairro'],
                'cidade' => $data['cidade'],
                'cep' => $data['cep'],
                'complemento' => $data['complemento'],
            ]);
        }
        else if($data['tipo'] == "M"){ //Mesa
            $last_pedido->detalheEntrega()->create([
                'tipo' => $data['tipo'],
                'mesa' => $data['mesa'],
                'pagamento' => $data['pagamento'],
            ]);
        }
        else if($data['tipo'] == "B"){ //Balcão
            $last_pedido->detalheEntrega()->create([
                'tipo' => $data['tipo'],
                'pagamento' => $data['pagamento'],
            ]);
        }

        $last_pedido->update([
            'status' => 'P'
        ]);

        return redirect()->route('cardapio');
    }

    public function historico()
    {
        $pedidos = Pedido::where([
            ['usuario_id', '=', auth()->id()],
            ['status', '<>', 'E'], // E editando, P processando, S saiu para entrega, F finalizado, C cancelado
        ])->orderByDesc('updated_at')->get();

        return view('geral.pedido.historico', [
            'pedidos' => $pedidos,
        ]);
    }

    public function show($id)
    {
        $pedido = Pedido::where([
            ['id', '=', $id],
            ['usuario_id', '=', auth()->id()],
        ])->first();
        
        if(empty($pedido)){
            return redirect()->route('pedido.historico');
        }
        
        return view('geral.pedido.show_historico', [
            'pedido' => $pedido,
        ]);
    }

    public function cancelar($id)
    {
        $pedido = Pedido::where([
            ['id', '=', $id],
            ['usuario_id', '=', auth()->id()],
        ])->first();

        if(empty($pedido)){
            return redirect()->route('pedido.historico');
        }

        $pedido->update([
            'status' => "C",
        ]);

        return redirect()->route('pedido.historico');
    }
}
