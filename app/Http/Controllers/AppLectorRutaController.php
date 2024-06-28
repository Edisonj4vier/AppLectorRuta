<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppLectorRutaController extends Controller
{
    private $apiUrl = 'http://localhost:8000'; // Reemplaza con la URL base de tu API

    public function index()
    {
        \Log::info('Accediendo a AppLectorRutaController@index');
        $usuarios = $this->getUsuarios();
        $rutas = $this->getRutas();
        $asignaciones = $this->getAsignaciones();

        return view('app_lector_ruta.index', compact('usuarios', 'rutas', 'asignaciones'));
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session('access_token'))
            ->post($this->apiUrl . '/asignarRuta/', [
                'usuario_id' => $request->id_usuario,
                'ruta_id' => $request->id_ruta,
            ]);

        if ($response->successful()) {
            return redirect()->route('app_lector_ruta.index')->with('success', 'Ruta asignada correctamente');
        }

        return redirect()->back()->with('error', 'Error al asignar la ruta');
    }

    public function update(Request $request, $id)
    {
        $response = Http::withToken(session('access_token'))
            ->post($this->apiUrl . '/asignarRuta/', [
                'usuario_id' => $id,
                'ruta_id' => $request->ruta_id,
            ]);

        if ($response->successful()) {
            return redirect()->route('app-lector-ruta.index')->with('success', 'Asignación actualizada correctamente');
        }

        return redirect()->back()->with('error', 'Error al actualizar la asignación');
    }

    public function destroy(Request $request, $id)
    {
        $response = Http::withToken(session('access_token'))
            ->delete($this->apiUrl . '/eliminarAsignacion/', [
                'usuario_id' => $id,
                'ruta_id' => $request->ruta_id,
            ]);

        if ($response->successful()) {
            return redirect()->route('app-lector-ruta.index')->with('success', 'Asignación eliminada correctamente');
        }

        return redirect()->back()->with('error', 'Error al eliminar la asignación');
    }

    private function getUsuarios()
    {
        $response = Http::withToken(session('access_token'))
            ->get($this->apiUrl . '/obtenerUsuarios/');

        return $response->json() ?? [];
    }

    private function getRutas()
    {
        $response = Http::withToken(session('access_token'))
            ->get($this->apiUrl . '/obtenerRutas/');

        return $response->json() ?? [];
    }

    private function getAsignaciones()
    {
        // Este método dependerá de cómo esté estructurada tu API
        // Por ahora, asumiremos que tienes un endpoint para obtener todas las asignaciones
        $response = Http::withToken(session('access_token'))
            ->get($this->apiUrl . '/obtenerAsignaciones/');

        return $response->json() ?? [];
    }
}
