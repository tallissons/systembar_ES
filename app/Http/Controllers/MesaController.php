<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;
use App\Models\Reserva;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::all();

        return view('reserva.mesas', [
            'mesas' => $mesas,
        ]);
    }

    public function cadastrar(Request $request)
    {
        $data = $request->all();

        Mesa::create($data);

        return redirect()->route('mesas');
    }

    public function excluir($id)
    {
        $mesa = Mesa::find($id);

        if(empty($mesa)){
            return redirect()->route('mesas');
        }

        $mesa->delete();

        return redirect()->route('mesas');
    }

    public function reservas()
    {
        $reservas = Reserva::all();

        return view('reserva.reservas', [
            'reservas' => $reservas,
        ]);
    }

    public function frmreservar()
    {
        $mesas = Mesa::all();

        return view('reserva.reservar', [
            'mesas' => $mesas,
        ]);
    }

    public function reservar(Request $request)
    {
        $data = $request->all();

        $mesa = Mesa::find($data['mesa_id']);

        if(empty($mesa)){
            return redirect()->route('frmreservar');
        }

        $reserva = Reserva::where([
            ['data_reserva', '=', $data['data_reserva']],
            ['mesa_id', '=', $data['mesa_id']]
            ])->first();

        if(!empty($reserva)){
            return redirect()->route('frmreservar')->withErrors(['message' => 'Mesa já reservada para essa data tente outra.']);
        }

        Reserva::create([
            'usuario_id' => auth()->id(),
            'mesa_id' => $data['mesa_id'],
            'data_reserva' => $data['data_reserva'],
            'pagamento' => $data['pagamento'],
        ]);

        return redirect()->route('frmreservar')->withErrors(['message' => 'Mesa reservada']);;
    }

    public function excluirReserva($id)
    {
        $reserva = Reserva::find($id);

        if(empty($reserva)){
            return redirect()->route('reservas');
        }

        $reserva->delete();

        return redirect()->route('reservas');
    }
}
