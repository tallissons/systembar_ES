@extends('portal.layout.app')

@section('title', 'System Bar')

@section('content')
    <h3 class="center">Mesas Cadastradas</h3>

    <div class="row">
        <a href="#mesa" class="view-item btn right">Cadastrar Mesa</a>
    </div>

    @if(count($mesas) > 0)
        <table class="highlight">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mesas as $mesa)
                    <tr>
                        <td>{{$mesa->nome}}</td>
                        <td>
                            <a onclick="exluirM('{{route('excluirMesa',$mesa->id)}}')" href="#!">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h5 class="center">Nenhuma mesa cadastrada.</h5>
    @endif

    <div id="mesa" class="modal" style="max-width: 400px;">
        <div class="modal-content">
            <div class="center">
                <h5>Mesa</h5>
                <form action="{{route('mesas.cadastrar')}}" method="post">
                    @csrf
                    <div class="input-field">
                        <input required type="text" autocomplete="off" name="nome">
                        <label>Nome</label>
                    </div>
                    <button class="btn" type="submit">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
@endsection



@push('ajax')
    $('.modal').modal();
@endpush

@push('js')
    <script>
        function exluirM($route){
            if(confirm('Tem certeza que deseja excluir!')){
                window.location=$route;
            }
        }
    </script>
@endpush
