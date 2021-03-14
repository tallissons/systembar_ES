@extends('portal.layout.app')

@section('title', 'System Bar')

@section('content')
    <h3 class="center">Histórico de Pedidos</h3>
    
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
                        @if($pedido->status == "F")
                            <span class="green-text">Finalizado</span>
                        @else
                            <span class="red-text">Cancelado</span>
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
            <h5>Nenhum pedido.</h5>
        </div>
    @endif
@endsection