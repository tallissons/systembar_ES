@extends('portal.layout.app')

@section('title', 'System Bar')

@section('content')
    <h3 class="center">Pedidos</h3>

    <div style='border-style: groove;' class="col s12 m6">
        <h5 class="center">Preparando</h5>
        @if(count($pedidos) > 0)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($pedidos as $pedido)
                        <tr>
                        <td>#{{$pedido->id}}</td>
                        <td>{{$pedido->usuario->nome}}</td>
                        <td>
                            @if($pedido->status == "P")
                            <span class="orange-text">Preparando</span>
                            @endif
                        </td>
                        <td> <a href="{{route('portal.pedido.show', $pedido->id)}}">Visualizar</a> </td>
                        </tr>
                    @endforeach
                </tr>
                </tbody>
            </table>
        @else
            <div class="center">
                <h5>Nenhum novo pedido.</h5>
            </div>
        @endif
    </div>



    <div style='border-style: groove;' class="col s12 m6">
        <h5 class="center">Saiu para entrega</h5>
        @if(count($pedidos_S) > 0)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($pedidos_S as $pedido)
                        <tr>
                        <td>#{{$pedido->id}}</td>
                        <td>{{$pedido->usuario->nome}}</td>
                        <td>
                            @if($pedido->status == "S")
                            <span class="blue-text">Saiu para Entrega</span>
                            @endif
                        </td>
                        <td> <a href="{{route('portal.pedido.show', $pedido->id)}}">Visualizar</a> </td>
                        </tr>
                    @endforeach
                </tr>
                </tbody>
            </table>
        @else
            <div class="center">
                <h5>Nenhum novo pedido.</h5>
            </div>
        @endif
    </div>
    
@endsection