@extends('portal.layout.app')

@section('title', 'System Bar')

@section('content')
    <h3 class="center">Gerenciar Cardápio</h3>

    <div class="row">
        <a class="waves-effect waves-light btn dropdown-button right" data-activates='btn-add' data-beloworigin="true"><i class="material-icons left">add</i>Adicionar</a>
    </div>

    <div class="row">
        @foreach($categorias as $categoria)
            <div id="" class="section scrollspy">
                <ul class="collection with-header">
                    <li class="collection-header">
                        <h5>
                            <a onclick="CategoriaDelete('{{$categoria->id}}', '{{$categoria->nome}}')" href="#!" class="red-text hide-on-med-and-down"><i class="material-icons small white">delete</i></a>
                            {{$categoria->nome}}
                        </h5>
                    </li>

                        @forelse($categoria->produtos()->get() as $produto)
                            <a href="#p{{$produto->id}}" class="collection-item view-item">{{$produto->nome}}<span class="badge">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span></a>

                            <!-- Modal Produto visualizar -->
                            <div id="p{{$produto->id}}" class="modal" style="max-height: 85%;">
                                <div class="modal-content">
                                    <h5 class="center">Produto</h5>

                                    <form action="{{route('cardapio.update', $produto->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col s12 m6 center">
                                                @if($produto->imagem != NULL)
                                                    <img id="img{{$produto->id}}" onclick='document.getElementById("inputImagem{{$produto->id}}").click();' style="max-width:100%; max-height:250px" src="{{url("storage/{$produto->imagem}")}}">
                                                @else
                                                    <img id="img{{$produto->id}}" onclick='document.getElementById("inputImagem{{$produto->id}}").click();' style="max-width:100%; max-height:250px" src="https://ladoaladopelavida.org.br/portal/Principal/arquivos/ImagemArquivos/121/SemImg.jpeg">
                                                @endif
                                                <a onclick='document.getElementById("inputImagem{{$produto->id}}").click();' class="col s12" href="#!">Adicionar Foto</a>
                                            </div>

                                            <input hidden type="file" id="inputImagem{{$produto->id}}" name="imagem">

                                            <div class="input-field col s12 m6">
                                                <input required type="text" autocomplete="off" name="nome" value="{{$produto->nome}}">
                                                <label>Nome</label>
                                            </div>

                                            <div class="input-field col s12 m6">
                                                <input required type="text" autocomplete="off" name="preco" onblur="$(this).mask('#.###,##', {reverse: true});" onkeypress="$(this).mask('#.###,##', {reverse: true});" MAXLENGTH=10 value="{{ number_format($produto->preco, 2, ',', '.')}}">
                                                <label>Preço R$</label>
                                            </div>

                                            <div class="input-field col s12 m6">
                                                <select name="categoria_id">
                                                    <option value="" >Outros</option>
                                                    @foreach($categorias as $categoria)
                                                        @if($categoria->id == $produto->categoria_id)
                                                            <option selected value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                                        @else
                                                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label>Categoria</label>
                                            </div>

                                            <div class="input-field col s12">
                                                <textarea id="textarea1" class="materialize-textarea" name="descricao">{{$produto->descricao}}</textarea>
                                                <label>Descrição</label>
                                            </div>
                                            <div class="col s12 center">
                                                <a onclick="produtoDelete('{{$produto->id}}','{{$produto->nome}}')" style="width:150px" class="btn red">Excluir</a>
                                                <button style="width:150px" class="btn" type="submit">Atualizar</button>
                                            </div>
                                        </div>
                                    </form>

                                    <form action="{{route('cardapio.delete', $produto->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input id="b{{$produto->id}}" hidden type="submit" name="">
                                    </form>

                                    @push('ajax')

                                    $('#inputImagem{{$produto->id}}').change(function(){
                                        const file = $(this)[0].files[0];
                                        const fileReader = new FileReader();
                                        fileReader.onloadend = function(){
                                            $('#img{{$produto->id}}').attr('src', fileReader.result);
                                        }
                                        fileReader.readAsDataURL(file);
                                    });

                                    @endpush
                                </div>
                            </div>
                        @empty
                            <a href="#!" class="collection-item center">Nenhum produto cadastrado</a>
                        @endforelse
                </ul>
            </div>

            <!-- Form para excluir categoria -->
            <form action="{{route('cardapio.categoria.delete')}}" method="post">
                @csrf
                @method('DELETE')
                <input id="idCategoriaDelete" hidden type="text" name="id">
                <input id="categoriaDelete" hidden type="submit">
            </form>
        @endforeach

        <div id="" class="section scrollspy">
                <ul class="collection with-header">
                    <li class="collection-header">
                        <h5>
                            Outros
                        </h5>
                    </li>

                        @forelse($produtos as $produto)
                            <a href="#p{{$produto->id}}" class="collection-item view-item">{{$produto->nome}}<span class="badge">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span></a>
                            <!-- Modal Produto visualizar -->
                            <div id="p{{$produto->id}}" class="modal" style="max-height: 85%;">
                                <div class="modal-content">
                                    <h5 class="center">Produto</h5>

                                    <form action="{{route('cardapio.update', $produto->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col s12 m6 center">
                                                @if($produto->imagem != NULL)
                                                    <img id="img{{$produto->id}}" onclick='document.getElementById("inputImagem{{$produto->id}}").click()' style="max-width:100%; max-height:250px" src="{{url("storage/{$produto->imagem}")}}">
                                                @else
                                                    <img id="img{{$produto->id}}" onclick='document.getElementById("inputImagem{{$produto->id}}").click()' style="max-width:100%; max-height:250px" src="https://ladoaladopelavida.org.br/portal/Principal/arquivos/ImagemArquivos/121/SemImg.jpeg">
                                                @endif
                                                <a onclick='document.getElementById("inputImagem{{$produto->id}}").click()' class="col s12" href="#!">Adicionar Foto</a>
                                            </div>

                                            <input hidden type="file" id="inputImagem{{$produto->id}}" name="imagem">

                                            <div class="input-field col s12 m6">
                                                <input required type="text" autocomplete="off" name="nome" value="{{$produto->nome}}">
                                                <label>Nome</label>
                                            </div>

                                            <div class="input-field col s12 m6">
                                                <input required type="text" autocomplete="off" name="preco" onblur="$(this).mask('#.###,##', {reverse: true});" onkeypress="$(this).mask('#.###,##', {reverse: true});" MAXLENGTH=10 value="{{ number_format($produto->preco, 2, ',', '.')}}">
                                                <label>Preço R$</label>
                                            </div>

                                            <div class="input-field col s12 m6">
                                                <select name="categoria_id">
                                                    <option value="" selected>Outros</option>
                                                    @foreach($categorias as $categoria)
                                                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                                    @endforeach
                                                </select>
                                                <label>Categoria</label>
                                            </div>

                                            <div class="input-field col s12">
                                                <textarea id="textarea1" class="materialize-textarea" name="descricao">{{$produto->descricao}}</textarea>
                                                <label>Descrição</label>
                                            </div>
                                            <div class="col s12 center">
                                                <a onclick="produtoDelete('{{$produto->id}}','{{$produto->nome}}')" style="width:150px" class="btn red">Excluir</a>
                                                <button style="width:150px" class="btn" type="submit">Atualizar</button>
                                            </div>
                                        </div>
                                    </form>

                                    <form action="{{route('cardapio.delete', $produto->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input id="b{{$produto->id}}" hidden type="submit" name="">
                                    </form>

                                    @push('ajax')

                                    $('#inputImagem{{$produto->id}}').change(function(){
                                        const file = $(this)[0].files[0];
                                        const fileReader = new FileReader();
                                        fileReader.onloadend = function(){
                                            $('#img{{$produto->id}}').attr('src', fileReader.result);
                                        }
                                        fileReader.readAsDataURL(file);
                                    });

                                    @endpush
                                </div>
                            </div>
                        @empty
                            <a href="#!" class="collection-item center">Nenhum produto cadastrado</a>
                        @endforelse
                </ul>
            </div>

    </div>

    <!-- Dropdown btn add -->
    <ul id='btn-add' class='dropdown-content'>
        <li><a href="#produtofrm" class="view-item"><i class="material-icons">add_shopping_cart</i>Produto</a></li>
        <li class="divider"></li>
        <li><a href="#categoriafrm" class="view-item"><i class="material-icons">view_module</i>Categória</a></li>
    </ul>

    <!-- Modal Produto -->
    <div id="produtofrm" class="modal" style="max-height: 85%;">
        <div class="modal-content">
            <h5 class="center">Produto</h5>

            <form action="{{route('cardapio.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col s12 m6 center">
                        <img id="img" onclick='imageUpload()' style="max-width:100%; max-height:250px" src="https://ladoaladopelavida.org.br/portal/Principal/arquivos/ImagemArquivos/121/SemImg.jpeg">
                        <a onclick='imageUpload()' class="col s12" href="#!">Adicionar Foto</a>
                    </div>

                    <input hidden type="file" id="inputImage" name="imagem">

                    <div class="input-field col s12 m6">
                        <input required type="text" autocomplete="off" name="nome">
                        <label>Nome</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <input required type="text" autocomplete="off" name="preco" onblur="$(this).mask('#.###,##', {reverse: true});" onkeypress="$(this).mask('#.###,##', {reverse: true});" MAXLENGTH=10>
                        <label>Preço</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <select name="categoria_id">
                            <option value="" selected>Outros</option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endforeach
                        </select>
                        <label>Categoria</label>
                    </div>

                    <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea" name="descricao"></textarea>
                        <label>Descrição</label>
                    </div>
                    <div class="col s12 center">
                        <button class="btn" type="submit">Adicionar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Produto Categoria-->
    <div id="produtofrm2" class="modal" style="max-height: 85%;">
        <div class="modal-content">
            <h5 class="center">Produto</h5>

            <form action="{{route('cardapio.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col s12 m6 center">
                        <img id="imgs" onclick='imageUpload2()' style="max-width:100%; max-height:250px" src="https://ladoaladopelavida.org.br/portal/Principal/arquivos/ImagemArquivos/121/SemImg.jpeg">
                        <a onclick='imageUpload2()' class="col s12" href="#!">Adicionar Foto</a>
                    </div>

                    <input hidden type="file" id="inputImagem" name="imagem">

                    <div class="input-field col s12 m6">
                        <input required type="text" autocomplete="off" name="nome">
                        <label>Nome</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <input required type="text" autocomplete="off" name="preco" onblur="$(this).mask('#.###,##', {reverse: true});" onkeypress="$(this).mask('#.###,##', {reverse: true});" MAXLENGTH=10>
                        <label>Preço</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <input id="nameSelect" disabled placeholder="Nenhuma Categoria" type="text">
                        <label>Categoria</label>
                    </div>

                    <input id="idSelect" hidden type="text" name="categoria_id">

                    <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea" name="descricao"></textarea>
                        <label>Descrição</label>
                    </div>
                    <div class="col s12 center">
                        <button class="btn" type="submit">Adicionar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Categoria -->
    <div id="categoriafrm" class="modal" style="max-width: 400px;">
        <div class="modal-content">
            <div class="center">
                <h5>Categoria</h5>
                <form action="{{route('cardapio.categoria')}}" method="post">
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

    <!-- Modal categoria update -->
    <div id="CategoriaUpdate" class="modal" style="max-width: 400px;">
        <div class="modal-content">
            <div class="center">
                <h5 class="row">Editar Categoria</h5>
                <form action="{{route('cardapio.categoria')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="input-field">
                        <input placeholder="Nome da Categoria" autocomplete="off" id="nomeCategoria" required type="text" name="nome">
                        <label>Nome</label>
                    </div>
                    <input id="idCategoria" hidden type="text" name="id">
                    <button class="btn" type="submit">Atualizar</button>
                </form>
            </div>
        </div>
    </div>

@endsection

<script>
    function imageUpload(){
        document.getElementById("inputImage").click();
    }
    function imageUpload2(){
        document.getElementById("inputImagem").click();
    }

    function CategoriaSelect($id, $name){
        document.getElementById('idSelect').value =$id;
        document.getElementById('nameSelect').value =$name;
    }

    function CategoriaUpdate($id, $name){
        document.getElementById('idCategoria').value =$id;
        document.getElementById('nomeCategoria').value =$name;
    }

    function CategoriaDelete($id, $name){
        if(confirm('Tem certeza que deseja excluir a categoria '+$name+'!\nPara excluir é necessario que não tenha nehum produto relacionado a ela.')){
            document.getElementById('idCategoriaDelete').value =$id;
            document.getElementById("categoriaDelete").click();
        }
    }

    function produtoDelete($id, $name){
        if(confirm('Tem certeza que deseja excluir o Produto '+$name+'!')){
            document.getElementById("b"+$id).click();
        }
    }
</script>

@push('ajax')
    $('.dropdown-button').dropdown();
    $('.modal').modal();
    $('select').material_select();

    $('#inputImage').change(function(){
        const file = $(this)[0].files[0];
        const fileReader = new FileReader();
        fileReader.onloadend = function(){
            $('#img').attr('src', fileReader.result);
        }
        fileReader.readAsDataURL(file);
    });

    $('#inputImagem').change(function(){
        const file = $(this)[0].files[0];
        const fileReader = new FileReader();
        fileReader.onloadend = function(){
            $('#imgs').attr('src', fileReader.result);
        }
        fileReader.readAsDataURL(file);
    });

    @foreach($errors->get('message') as $message)
        Materialize.toast("{{$message}}", 5000)
    @endforeach
@endpush


