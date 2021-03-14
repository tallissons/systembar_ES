@extends('geral.layout.app')

@section('title', 'Cardápio')

@section('content')
    <h3 class="center">Cardápio</h3>

    <input class="col s12" id="myInput" type="text" placeholder="Pesquisar..">

    <section id="mysection" class="row">

        @foreach($categorias as $category)
            <section>
                @if($category->produtos->first())
                    <h5 class="col s12">{{$category->nome}}</h5>
                @endif

                @foreach($category->produtos as $product)
                    <article style="height:350px" class="col s12 m4">
                        <div style="height:300px" href="#modal{{$product->id}}" class="card hoverable view-item" onclick="resetQNT()">
                            <div class="card-image">
                                @if($product->imagem != NULL)
                                <img style="max-height:150px; min-height:150px" src="{{url("storage/{$product->imagem}")}}" alt="{{$product->nome}}">
                                @else
                                <img style="max-height:150px; min-height:150px" src="https://www.strokejoinville.com.br/wp-content/uploads/sites/804/2017/05/produto-sem-imagem-Copia-Copia-Copia-Copia.gif" alt="sem imagem">
                                @endif
                            </div>
                            <div class="card-content">
                                <span class="card-title">{{$product->nome}}</span>
                                <p hidden>{{$category->nome}}</p>
                                <p>R$ {{ number_format($product->preco, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </article>

                    @include('geral._includes.show_produto')
                @endforeach
            </section>

        @endforeach

        <section>
            @if($produtos->first())
                <h5 class="col s12">Outros</h5>
            @endif

            @foreach($produtos as $product)
                <article class="col s12 m4">
                    <div href="#modal{{$product->id}}" class="card hoverable view-item" onclick="resetQNT()">
                    <div class="card-image">
                        @if($product->imagem != NULL)
                        <img style="max-height:150px; min-height:150px" src="{{url("storage/{$product->imagem}")}}" alt="{{$product->nome}}">
                        @else
                        <img style="max-height:150px; min-height:150px" src="https://www.strokejoinville.com.br/wp-content/uploads/sites/804/2017/05/produto-sem-imagem-Copia-Copia-Copia-Copia.gif" alt="sem imagem">
                        @endif
                    </div>
                    <div class="card-content">
                        <span class="card-title">{{$product->nome}}</span>
                        <p hidden>Outros</p>
                        <p>R$ {{ number_format($product->preco, 2, ',', '.') }}</p>
                    </div>
                    </div>
                </article>

                @include('geral._includes.show_produto')
            @endforeach
        </section>

    </section>


@endsection

@push('ajax')
    //Filtro do cardapio


    $('.modal').modal();
@endpush
