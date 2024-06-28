<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function index()
    {
        $token = session('access_token');
        if (!$token) {
            return redirect('/login');
        }

        $usuarios = $this->authService->obtenerUsuarios($token);
        $rutas = $this->authService->obtenerRutas($token);
        $asignaciones = $this->obtenerAsignaciones($token);

        return view('app_lector_ruta.index', compact('usuarios', 'rutas', 'asignaciones'));
    }

    public function store(Request $request)
    {
        $token = session('access_token');
        if (!$token) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'id_usuario' => 'required|integer',
            'id_ruta' => 'required|integer',
        ]);

        $result = $this->authService->asignarRuta($validated['id_usuario'], $validated['id_ruta'], $token);

        if (isset($result['error'])) {
            return back()->withErrors(['error' => $result['error']]);
        }

        return redirect()->route('app_lector_ruta.index')->with('success', 'Ruta asignada correctamente');
    }

    public function destroy($id)
    {
        $token = session('access_token');
        if (!$token) {
            return redirect('/login');
        }

        // Aquí necesitarías obtener el id_ruta de alguna manera, quizás pasándolo como un parámetro adicional
        $id_ruta = request('id_ruta');

        $result = $this->authService->eliminarAsignacion($id, $id_ruta, $token);

        if (isset($result['error'])) {
            return back()->withErrors(['error' => $result['error']]);
        }

        return redirect()->route('app_lector_ruta.index')->with('success', 'Asignación eliminada correctamente');
    }

    private function obtenerAsignaciones($token)
    {
        $usuarios = $this->authService->obtenerUsuarios($token);
        $asignaciones = [];

        foreach ($usuarios as $usuario) {
            $rutasUsuario = $this->authService->obtenerRutaUsuario($usuario['id'], $token);
            $asignaciones[] = [
                'usuario' => $usuario,
                'rutas' => $rutasUsuario
            ];
        }

        return $asignaciones;
    }

}
