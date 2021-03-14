@extends('geral.layout.app')

@section('title', 'Histórico')

@section('content')
    <div class="center row">
        <h5>Histórico de Pedidos</h5>
    </div>

    @if(count($pedidos) > 0)
        <table class="highlight">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Data / Hora</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($pedidos as $pedido)
                    <tr>
                    <td>#{{$pedido->id}}</td>
                    <td>{{date_format($pedido->created_at,"d/m/Y H:i:s")}}</td>
                    <td>
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
                    </td>
                    <td> <a href="{{route('pedido.show', $pedido->id)}}">Visualizar</a> </td>
                    </tr>
                @endforeach
            </tr>
            </tbody>
        </table>
    @else
        <div class="center">
            <h5>Você ainda não fez nenhum pedido</h5>
        </div>
    @endif

@endsection