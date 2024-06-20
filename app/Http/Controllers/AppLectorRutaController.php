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

        // Verificar si el lector y la ruta ya estan asignados
        $registroExistente = AppLectorRuta::where('id_usuario', $request->input('id_usuario'))
            ->where('id_ruta', $request->input('id_ruta'))
            ->first();
        if ($registroExistente) {
            return redirect()->route('app-lector-ruta.index')->with('error', 'El lector ya se encuentra asignado a esta ruta.');
        }

        // Verificar si la ruta ya esta asignado a otro lector
        $rutaAsignada = AppLectorRuta::where('id_ruta', $request->input('id_ruta'))->first();
        if ($rutaAsignada) {
            return redirect()->route('app-lector-ruta.index')->with('error', 'La ruta ya se encuentra asignada a otro lector.');
        }

        $appLectorRuta = new AppLectorRuta();
        $appLectorRuta->id_usuario = $request->id_usuario;
        $appLectorRuta->id_ruta = $request->id_ruta;
        $appLectorRuta->save();
        return redirect()->route('app-lector-ruta.index')->with('success','Registro agregado correctamente');
    }

    public function destroy($id)
    {
        $appLectorRuta = AppLectorRuta::findOrFail($id);
        $appLectorRuta->delete();

        return redirect()->route('app-lector-ruta.index')->with('success','Registro eliminado correctamente');
    }

    public function edit($id)
    {
        $appLectorRuta = AppLectorRuta::with(['usuario', 'ruta'])->findOrFail($id);
        $usuarios = Usuario::all();
        $rutas = Ruta::all();

        return response()->json([
            'appLectorRuta' => $appLectorRuta,
            'usuarios' => $usuarios,
            'rutas' => $rutas
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_usuario' => 'required',
            'id_ruta' => 'required',
        ]);

        $appLectorRuta = AppLectorRuta::findOrFail($id);
        $appLectorRuta->update($request->all());

        return redirect()->back()->with('success', 'Ruta del lector actualizada exitosamente');
    }

}
