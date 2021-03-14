@extends('geral.layout.app')

@section('title', 'Histórico')

@section('content')
    <div class="center row">
        <h5>Fazer Reserva</h5>
    </div>

    <form action="{{route('reservar')}}" method="post">
        @csrf
        <label class="left" >Data da reserva</label>
        <div class="input-field">
            <input required  placeholder="Placeholder" type="date" name="data_reserva">
        </div>

        <label>Selecione a mesa que deseja reservar</label>
        <select name="mesa_id" class="browser-default">
            @foreach($mesas as $mesa)
                <option value="{{$mesa->id}}">{{$mesa->nome}}</option>
            @endforeach
        </select>
        <br>
        <label>Pagamento R$ 5,00</label>
        <select name="pagamento" class="browser-default">
            <option value="D">Dinheiro</option>
            <option value="C">Maquininha de Cartão</option>
        </select>
        <br>
        <button class="btn blue" type="submit">Reservar</button>
    </form>
@endsection

@push('ajax')
    @foreach($errors->get('message') as $message)
        Materialize.toast("{{$message}}", 5000)
    @endforeach
@endpush