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
        $appLectorRutas = AppLectorRuta::with('usuario', 'ruta')->get();
        $routeAdded = session('route_added', false);

        return view('app_lector_ruta.index', compact('usuarios', 'rutas', 'appLectorRutas', 'routeAdded'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuario,id',
            'id_ruta' => 'required|exists:ruta,id',
        ]);

        // Verificar si el lector y la ruta ya están asignados
        $registroExistente = AppLectorRuta::where('id_usuario', $request->id_usuario)
            ->where('id_ruta', $request->id_ruta)
            ->first();

        if ($registroExistente) {
            return redirect()->route('app-lector-ruta.index')->with('error', 'El lector ya se encuentra asignado a esta ruta.');
        }

        // Verificar si la ruta ya está asignada a otro lector
        $rutaAsignada = AppLectorRuta::where('id_ruta', $request->id_ruta)->first();

        if ($rutaAsignada) {
            return redirect()->route('app-lector-ruta.index')->with('error', 'La ruta ya se encuentra asignada a otro lector.');
        }

        AppLectorRuta::create([
            'id_usuario' => $request->id_usuario,
            'id_ruta' => $request->id_ruta
        ]);

        return redirect()->route('app-lector-ruta.index')->with('success', 'Ruta agregada correctamente')->with('route_added', true);
    }

    public function destroy($id)
    {
        $appLectorRuta = AppLectorRuta::findOrFail($id);
        $appLectorRuta->delete();

        return redirect()->route('app-lector-ruta.index')->with('success', 'Registro eliminado correctamente');
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
            'id_usuario' => 'required|exists:usuario,id',
            'id_ruta' => 'required|exists:ruta,id',
        ]);

        $appLectorRuta = AppLectorRuta::findOrFail($id);
        $appLectorRuta->update($request->all());

        return redirect()->back()->with('success', 'Ruta del lector actualizada exitosamente');
    }
}
