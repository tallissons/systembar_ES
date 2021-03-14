<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermissao;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/s', function () {
    return view('geral.home');
})->name('cardapio');

Route::group([
    'namespace' => 'App\Http\Controllers',
], function (){

    //Auth
    Route::post('/auth', 'Auth\\AuthController@authenticate')->name('auth');
    Route::get('/logout', 'Auth\\AuthController@logout')->name('logout')->middleware('auth');
    Route::get('/login', 'Auth\\AuthController@formLogin')->name('login');
    Route::get('/register', 'Auth\\AuthController@formRegister')->name('formRegister');
    Route::post('/register', 'Auth\\AuthController@register')->name('register');

    //Rotas que so Administrador pode acessar
    Route::get('/cardapio', 'Portal\\Cardapio\\CardapioController@index')->name('portal.cardapio')->middleware(['auth', CheckPermissao::class]);
    Route::group([
        'middleware' => ['auth', CheckPermissao::class],
        'prefix' => 'portal',
        'namespace' => 'Portal'
      ], function(){
          Route::get('/', 'HomeController@index')->name('portal.home');

          //Gerenciamento de cardapio
          Route::post('/cardapio', 'Cardapio\\CardapioController@store')->name('cardapio.store');
          Route::put('/cardapio/produto/{produto_id}', 'Cardapio\\CardapioController@update')->name('cardapio.update');
          Route::post('/cardapio/categoria', 'Cardapio\\CardapioController@categoriaStore')->name('cardapio.categoria');
          Route::put('/cardapio/categoria', 'Cardapio\\CardapioController@categoriaUpdate')->name('cardapio.categoria');
          Route::delete('/cardapio/categoria', 'Cardapio\\CardapioController@categoriaDelete')->name('cardapio.categoria.delete');
          Route::get('/cardapio/produto/{produto_id}', 'Cardapio\\CardapioController@show')->name('cardapio.produto');
          Route::delete('/cardapio/produto/{produto_id}', 'Cardapio\\CardapioController@destroy')->name('cardapio.delete');

          Route::get('/pedidos', 'Pedido\\PedidoController@index')->name('portal.pedidos');
          Route::get('/pedidos/historico', 'Pedido\\PedidoController@historico')->name('portal.pedidos.historico');
          Route::get('/pedido/{id}', 'Pedido\\PedidoController@show')->name('portal.pedido.show');
          

          Route::get('entregar/pedido/{id}', 'Pedido\\PedidoController@entregar')->name('portal.pedido.entregar');
          Route::get('finalizar/pedido/{id}', 'Pedido\\PedidoController@finalizar')->name('portal.pedido.finalizar');
          Route::get('cancelar/pedido/{id}', 'Pedido\\PedidoController@cancelar')->name('portal.pedido.cancelar');

          Route::get('/usuarios', 'UsuariosController@index')->name('usuarios');
    });

    //Rotas do Cliente
    Route::get('/', 'Geral\\CardapioController@index')->name('cardapio');
    Route::group([
        'middleware' => 'auth',
        'namespace' => 'Geral',
    ], function(){
        Route::get('/carrinho', 'CarrinhoController@index')->name('carrinho');
        Route::post('/carrinho', 'CarrinhoController@add')->name('carrinho.add');
        Route::get('/item/{id}', 'CarrinhoController@remover')->name('carrinho.remover');
        Route::post('/pedido', 'PedidoController@detalhesPedido')->name('pedido');
        Route::get('/historico', 'PedidoController@historico')->name('pedido.historico');
        Route::get('/pedido/{id}', 'PedidoController@show')->name('pedido.show');
        Route::get('cancelar/pedido/{id}', 'PedidoController@cancelar')->name('pedido.cancelar');
    });

    Route::group([
        'middleware' => ['auth', CheckPermissao::class],
    ], function(){
        //Reservas
        Route::get('/reservas', 'MesaController@reservas')->name('reservas');
        Route::get('/reserva/{id}', 'MesaController@excluirReserva')->name('excluirReserva');
        Route::get('/mesas', 'MesaController@index')->name('mesas');
        Route::post('/mesas', 'MesaController@cadastrar')->name('mesas.cadastrar');
        Route::get('/mesas/{id}', 'MesaController@excluir')->name('excluirMesa');
    });

    Route::get('/reservar', 'MesaController@frmreservar')->name('frmreservar')->middleware('auth');
    Route::post('/reservar', 'MesaController@reservar')->name('reservar')->middleware('auth');
});
