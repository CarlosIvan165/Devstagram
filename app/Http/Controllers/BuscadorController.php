<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function index()
    {
       return view('buscador');
    }

    public function buscar(Request $request)
    {
        $usuario = $request->input('usuario');

        $username = User::where('username', 'like', "%{$usuario}%")
                         ->orWhere('email', 'like', "%{$usuario}%")
                         ->get();

        return view('buscador', [
            'username' => $username,
            'usuario' => $usuario, // <- esto es importante
        ]);
    }
}
