<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Reserva;

class HomeController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('status', 'P')->take(5)->get();

        $reservas = Reserva::take(5)->get();
        
        return view('portal.home', [
            'pedidos' => $pedidos,
            'reservas' => $reservas
        ]);
    }
}
