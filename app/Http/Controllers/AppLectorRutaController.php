<?php

namespace App\Http\Controllers;

use App\Models\AppLectorRuta;
use App\Models\Ruta;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AppLectorRutaController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        $rutas = Ruta::all();
        $appLectorRutas = AppLectorRuta::with('usuario','ruta')->get();

        return view('app_lector_ruta.index', compact('usuarios', 'rutas', 'appLectorRutas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuario,id',
            'id_ruta' => 'required|exists:ruta,id',
        ]);

        AppLectorRuta::create($request->all());

        return redirect()->route('app-lector-ruta.index');
    }

    public function destroy($id)
    {
        $appLectorRuta = AppLectorRuta::findOrFail($id);
        $appLectorRuta->delete();

        return redirect()->route('app-lector-ruta.index');
    }
}
