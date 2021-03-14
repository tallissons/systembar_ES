@extends('portal.layout.app')

@section('title', 'System Bar')

@section('content')
    <h3 class="center">Usuários</h3>

    <div class="card-panel">
        <h5 class="center">Administradores</h5>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->nome}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->telefone}}</td>
                    </tr>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>

    <div class="card-panel">
        <h5 class="center">Clientes</h5>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->nome}}</td>
                        <td>{{$cliente->email}}</td>
                        <td>{{$cliente->telefone}}</td>
                    </tr>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
    
@endsection
