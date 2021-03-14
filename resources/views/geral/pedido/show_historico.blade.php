@extends('geral.layout.app')

@section('title', 'Histórico')

@section('content')

    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <div class="right">
                    <p> <strong>Pedido: #{{$pedido->id}}</strong> </p>
                    <p>Data: {{date_format($pedido->created_at,"d/m/Y - H:i:s")}}</p>
                    <p>Status: 
                        @if($pedido->status == "P")
                            <span class="orange-text">Preparando</span>
                        @endif
                        @if($pedido->status == "S")
                            <span class="blue-text">Saiu para Entrega</span>
                        @endif
                        @if($pedido->status == "F")
                            <span class="green-text">Finalizado</span>
                        @endif
                        @if($pedido->status == "C")
                            <span class="red-text">Cancelado</span>
                        @endif
                    </p>
                </div>
                
                <p> <strong>Cliente</strong> </p>
                <h6>{{$pedido->usuario->nome}}</h6>
                <h6>{{$pedido->usuario->telefone}}</h6>
                <h6>{{$pedido->usuario->email}}</h6>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <div class="right">
                    <p> <strong>Pagamento: </strong> 
                        @if($pedido->detalheEntrega->pagamento == 'D')
                            <span>Dinheiro</span>
                        @else
                            <span>Maquininha de Cartão</span>
                        @endif
                    </p>
                </div>
                <p> <strong>Detalhes de entrega:</strong> </p>

                @if($pedido->detalheEntrega->tipo == 'D')
                    <h6>Endereço: </h6>
                    <div>
                        <h6>{{$pedido->detalheEntrega->enderecoEntrega->rua}}, {{$pedido->detalheEntrega->enderecoEntrega->numero}} - {{$pedido->detalheEntrega->enderecoEntrega->complemento}}</h6>
                        <h6>{{$pedido->detalheEntrega->enderecoEntrega->bairro}}</h6>
                        <h6>{{$pedido->detalheEntrega->enderecoEntrega->cidade}} - {{$pedido->detalheEntrega->enderecoEntrega->cep}}</h6>
                    </div>
                @endif

                @if($pedido->detalheEntrega->tipo == 'M')
                    <h6>Entregar na mesa: {{$pedido->detalheEntrega->mesa}}</h6>
                @endif

                @if($pedido->detalheEntrega->tipo == 'B')
                    <h6>Retirar no balcão</h6>
                @endif
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card-panel">

                <table class="bordered">
                    <thead>
                        <tr>
                            <th><strong>Itens do pedido:</strong></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_pedido = 0;
                        @endphp

                        @foreach($pedido->itensPedido()->get() as $itemPedido)
                            <tr>
                                <td>
                                {{$itemPedido->quantidade}}x {{$itemPedido->produto->nome}}
                                    <h6><small> <strong>Obs:</strong> {{($itemPedido->observacao) ? $itemPedido->observacao : ''}}</small></h6>
                                </td>

                                @php
                                    $total_produto = $itemPedido->quantidade * $itemPedido->produto->preco;
                                    $total_pedido += $itemPedido->produto->preco * $itemPedido->quantidade;
                                @endphp

                                <td>R$ {{number_format($total_produto, 2, ',', '.')}}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td> <strong>Total</strong> </td>
                            <td>R$ {{number_format($total_pedido, 2, ',', '.')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        @if($pedido->status == "P")
            <div class="col s12">
                <div class="card-panel center">
                    <a href="{{route('pedido.cancelar', $pedido->id)}}" class="btn red">Cancelar</a>
                </div>
            </div>
        @endif
    </div>

@endsection