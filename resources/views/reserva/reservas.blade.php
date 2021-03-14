@extends('portal.layout.app')

@section('title', 'System Bar')

@section('content')
    <h3 class="center">Reservas</h3>

    @if(count($reservas) > 0)
        <table class="highlight">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Mesa Reservada</th>
                    <th>Data da Reserva</th>
                    <th>Pagamento</th>
                    <th>Ação</th>
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
                                Maquininha de Cartão
                            @endif
                        </td>
                        <td>
                            <a onclick="exluirR('{{route('excluirReserva',$reserva->id)}}')" href="#!">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h5 class="center">Nenhuma mesa reservada.</h5>
    @endif
@endsection

@push('js')
    <script>
        function exluirR($route){
            if(confirm('Tem certeza que deseja excluir!')){
                window.location=$route; 
            }
        }
    </script>
@endpush