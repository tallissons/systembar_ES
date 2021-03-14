<?php

namespace App\Http\Controllers\Portal\Cardapio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\CategoriaProduto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CardapioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::whereNull('categoria_id')->get();
        $categorias = CategoriaProduto::all();
        
        return view('portal.cardapio.index', [
            'produtos' => $produtos,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price = Str::replaceArray('.', [''], $request['preco']);
        $request['preco'] = Str::replaceArray(',', ['.'], $price);

        $data = $request->all();
        
        if($request->hasFile('imagem') && $request->imagem->isValid()){
            $imagePath = $request->imagem->store('produtos');
            $data['imagem'] = $imagePath;
        }
        
        Produto::create($data);

        return redirect()->route('portal.cardapio');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);

        if(empty($produto)){
            return redirect()->route('portal.cardapio');
        }

        return view('portal.cardapio.produto', [
            'produto' => $produto,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if(empty($produto)){
            return redirect()->route('portal.cardapio');
        }

        $price = Str::replaceArray('.', [''], $request['preco']);
        $request['preco'] = Str::replaceArray(',', ['.'], $price);

        $data = $request->all();

        if($request->hasFile('imagem') && $request->imagem->isValid()){

            if($produto->imagem && Storage::exists($produto->imagem)){
            Storage::delete($produto->imagem);
            }

            $imagePath = $request->imagem->store('produtos');
            $data['imagem'] = $imagePath;
        }

        $produto->update($data);

        return redirect()->route('portal.cardapio')->withErrors(['message' => 'Produto '.$produto->nome.' alterado.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if(empty($produto)){
            return redirect()->route('portal.cardapio');
        }

        if($produto->imagem && Storage::exists($produto->imagem)){
            Storage::delete($produto->imagem);
        }

        $produto->delete();

        return redirect()->route('portal.cardapio')->withErrors(['message' => 'Produto '.$produto->nome.' excluido.']);
    }

    public function categoriaStore(Request $request)
    {
        $data = $request->all();

        CategoriaProduto::create($data);

        return redirect()->route('portal.cardapio');
    }

    public function categoriaUpdate(Request $request)
    {
        $data = $request->all();

        $categoria = CategoriaProduto::find($data['id']);

        if(empty($categoria)){
            return redirect()->route('portal.cardapio');
        }

        $categoria->update($data);

        return redirect()->route('portal.cardapio');
    }

    public function categoriaDelete(Request $request)
    {
        $data = $request->all();
        $categoria = CategoriaProduto::find($data['id']);

        if(empty($categoria)){
            return redirect()->route('portal.cardapio');
        }

        if($categoria->produtos()->first()){
            return redirect()->route('portal.cardapio')->withErrors(['message' => 'Não foi possivel remover a categoria '.$categoria->nome.' porque ela contem produtos.']);
        }

        $categoria->delete();

        return redirect()->route('portal.cardapio')->withErrors(['message' => 'Categoria '.$categoria->nome.' excluido.']);;
    }
}
