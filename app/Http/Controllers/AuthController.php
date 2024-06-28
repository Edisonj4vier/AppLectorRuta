<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required',
            'contrasena' => 'required',
        ]);

        $client = new Client();

        try {
            $response = $client->post('http://localhost:8000/login/', [
                'json' => [
                    'nombre_usuario' => $request->nombre_usuario,
                    'contrasena' => $request->contrasena,
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            // Guardar el token en la sesión

            session(['access_token' => $data['access_token']]);
            session(['user_id' => $data['user_id']]);

// Log para confirmar que se guardó la sesión
            \Log::info('Token guardado en sesión:', [
                'access_token' => session('access_token'),
                'user_id' => session('user_id')
            ]);
            \Log::info('Intentando redirigir a app-lector-ruta.index');
            return redirect()->route('app-lector-ruta.index')->with('success', 'Inicio de sesión exitoso');


        } catch (RequestException $e) {
            // Log del error
            \Log::error('Error en login: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Credenciales incorrectas']);
        }
    }

    public function logout()
    {
        session()->forget(['access_token', 'user_id']);
        return redirect()->route('login')->with('success', 'Sesión cerrada exitosamente');
    }
}
