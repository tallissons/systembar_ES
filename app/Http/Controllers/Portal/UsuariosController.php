<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    public function index()
    {
        $clientes = Usuario::where('permissao', 0)->get();
        $admins = Usuario::where('permissao', 1)->get();

        return view('portal.usuario.index', [
            'clientes' => $clientes,
            'admins' => $admins
        ]);
    }
}
