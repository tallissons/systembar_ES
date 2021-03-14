@extends('portal.layout.app')

@section('title', 'SystemBar')

@section('content')
    <h3 class="center">Bem vindo ao painel de gerenciamento do SystemBar!</h3>

    <div style='border-style: groove; border-radius: 10px;' class="col s12 m6">
        <h5 class="center">Utimos 5 Pedidos</h5>
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



    <div style='border-style: groove;border-radius: 10px;' class="col s12 m6">
        <h5 class="center">Utimas 5 Reservas</h5>
        @if(count($reservas) > 0)
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Mesa</th>
                        <th>Data da Reserva</th>
                        <th>Pagamento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td>{{$reserva->usuario->nome}}</td>
                            <td>{{$reserva->mesa->nome}}</td>
                            <td>{{date("d/m/Y", strtotime($reserva->data_reserva))}}</td>
                            <td>
                                @if($reserva->pagamento == "D")
                                    Dinheiro
                                @else
                                    Maquininha
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h5 class="center">Nenhuma mesa reservada.</h5>
        @endif
    </div>
@endsection
