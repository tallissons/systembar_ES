@extends('geral.layout.app')

@section('title', 'Carrinho')

@section('content')
    <div class="row center">
        <h4>Carrinho</h4>
    </div>

    <div class="row">
        @if(!empty($pedido) && $pedido->itensPedido()->first() != NULL)
        <table class="bordered row">
            <thead>
                <tr>
                    <th>Itens</th>
                    <th></th>
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
                    <td><a  class="btn-floating waves-effect waves-light red" href="{{route('carrinho.remover', $itemPedido->id)}}"><i class="material-icons">delete</i></a></td>
                </tr>
            @endforeach

                <tr>
                    <td> <strong>Total</strong> </td>
                    <td>R$ {{number_format($total_pedido, 2, ',', '.')}}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <form action="{{route('pedido')}}" method="post">
        @csrf
        <h5>Entrega:</h5>
            <div style="padding-left:50px" class="row">
                <p>
                    <input required class="with-gap" name="tipo" type="radio" id="delivery" value="D"/>
                    <label for="delivery">Delivery</label>
                </p>

                <div style="padding-left:50px; display: none;" class="row" id="endereco">
                    <div class="input-field col s6">
                        <input type="text" autocomplete="off" class="validate" name='rua'>
                        <label>Rua</label>
                    </div>

                    <div class="input-field col s6">
                        <input type="text" autocomplete="off" class="validate" name='numero'>
                        <label >Numero</label>
                    </div>

                    <div class="input-field col s6">
                        <input  type="text" autocomplete="off" class="validate" name='bairro'>
                        <label>Bairro</label>
                    </div>

                    <div class="input-field col s6">
                        <input type="text" autocomplete="off" class="validate" name='complemento'>
                        <label >Complemento</label>
                    </div>

                    <div class="input-field col s6">
                        <input type="text" autocomplete="off" class="validate" name='cidade'>
                        <label>Cidade</label>
                    </div>

                    <div class="input-field col s6">
                        <input type="text" autocomplete="off" class="validate" name='cep'>
                        <label>CEP</label>
                    </div>

                </div>
                <p>
                    <input required class="with-gap" name="tipo" type="radio" id="mesa" value="M"/>
                    <label for="mesa">Mesa</label>
                </p>

                <div style="padding-left:50px; display: none;" class="row" id="numMesa">
                    <label>Entregar na mesa</label>
                    <select name="mesa" class="browser-default">
                        <option >Selecione uma messa</option>
                        @foreach($mesas as $mesa)
                            <option value="{{$mesa->id}}">{{$mesa->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <p>
                    <input required class="with-gap" name="tipo" type="radio" id="balcao" value="B"/>
                    <label for="balcao">Balcão</label>
                </p>
            </div>

            <h5>Pagamento:</h5>
            <div style="padding-left:50px" class="row">
                <p>
                    <input required class="with-gap" name="pagamento" type="radio" id="dinheiro" value="D"/>
                    <label for="dinheiro">Dinheiro</label>
                </p>
                <p>
                    <input required class="with-gap" name="pagamento" type="radio" id="cartao" value="C"/>
                    <label for="cartao">Maquininha de Cartão</label>
                </p>
            </div>

            <div class="right">
                <a class="btn" href="{{route('cardapio')}}">Continuar Comprando</a>
                <button class="btn red" type="submit">Concluir Compra</button>
            </div>
        </form>
        @else
            <h5 class="center">Carrinho Vazio!</h5>
        @endif
    </div>
@endsection

@push('ajax')
    $("#endereco").hide();

    $("#delivery").click(function(){
        $("#numMesa").hide();
        $("#endereco").show();
    });

    $("#numMesa").hide();

    $("#mesa").click(function(){
        $("#endereco").hide();
        $("#numMesa").show();
    });

    $("#balcao").click(function(){
        $("#numMesa").hide();
        $("#endereco").hide();
    });
@endpush