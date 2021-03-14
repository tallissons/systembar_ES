

<div id="modal{{$product->id}}" class="modal bottom-sheet modal-fixed-footer">

<nav class="white">
  <span class="brand-logo center black-text">Detalhes </span>
  <ul class="left">
    <li><a href="#" class="modal-action modal-close  btn-flat"><i class="material-icons" onclick="resetInputQnt('{{$product->id}}', '{{ number_format($product->preco, 2, ',', '.') }}')">expand_more</i></a></li>
  </ul>
</nav>


  <div style="max-height: 85%;" class="modal-content row">

    <div class="center">
        @if($product->imagem != NULL)
            <img style="height:150px; border-radius: 10px;" src="{{url("storage/{$product->imagem}")}}" alt="{{$product->nome}}">
        @else
            <img style="height:150px; border-radius: 10px;" src="https://www.strokejoinville.com.br/wp-content/uploads/sites/804/2017/05/produto-sem-imagem-Copia-Copia-Copia-Copia.gif" alt="sem imagem">
        @endif
        <h5>{{$product->nome}}</h5>
    </div>

    <div class="col s12 row">
      <span class="col s12 m4"></span>
      <span class="col s12 m4">{!!$product->descricao!!}</span>
      <span class="col s12 m4"></span>
    </div>

    <div class="col s12 row">
      <span class="col s12 m4"></span>
      <span class="col s12 m4">R$ {{ number_format($product->preco, 2, ',', '.') }}</span>
      <span class="col s12 m4"></span>
    </div>

    <div class="input-field col s12 center">
    <form class="" action="{{route('carrinho.add')}}" method="post">
    @csrf
        <input type="hidden" id="inQnt{{$product->id}}" name="quantidade" value="1">
        <input type="hidden" id="inQnt{{$product->id}}" name="produto_id" value="{{$product->id}}">
        <span class="col s12 m4"></span>
        <input placeholder="Observação sobre o pedido..." type="text" class="col s12 m4" autocomplete="off" name="observacao">
        <span class="col s12 m4"></span>
      </div>

  </div>

  <div style="text-align:center" class="modal-footer">
        <div class="col s12 m6 xl4 right">
            <div class="left">
            <div style="border-style: solid; width:100px; height:35px; margin-top: 5px;" class="right">
                <i onclick="document.getElementById('qnt{{$product->id}}').innerHTML=remove('{{$product->preco}}', '{{$product->id}}') " style="border-style: solid; margin-right:0px" class="material-icons grey left waves-effect">remove</i>
                <span> <strong id="qnt{{$product->id}}">1</strong> </span>
                <i onclick="document.getElementById('qnt{{$product->id}}').innerHTML=add('{{$product->preco}}', '{{$product->id}}') " style="border-style: solid; margin-left: 0px;" class="material-icons grey right waves-effect">add</i>
            </div>
            </div>
            <button href="#!" class="btn waves-effect col s7 right truncate">Adicionar <span id="total{{$product->id}}" type="text">R$ {{ number_format($product->preco, 2, ',', '.') }}</span> </button>
        </div>
    </form>

  </div>
</div>

<script>
  var qnt = 1;

  function resetQNT(){
      qnt = 1;
  }

  function resetInputQnt(id, preco){
      $('#qnt'+id).text('1');
      $('#inQnt'+id).val('1');
      $('#total'+id).text(preco);
  }

  function add(valor, id) {
    if(qnt >= 99){
      return qnt;
    }
    qnt = qnt + 1;
    total = valor * qnt;
    document.getElementById('total'+id).innerHTML= Number(total).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    $('#inQnt'+id).val(qnt);
    return qnt;
  }
  function remove(valor, id) {
    if(qnt <= 1){
      return qnt;
    }
      qnt = qnt - 1;
    total = valor * qnt;
    document.getElementById('total'+id).innerHTML= Number(total).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    $('#inQnt'+id).val(qnt);
    return qnt;
  }
</script>
