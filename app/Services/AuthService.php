<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AuthService
{
    protected $client;
    protected $apiUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = env('API_BASE_URL', 'http://localhost:8000');
    }

    public function login($username, $password)
    {
        try {
            $response = $this->client->post($this->apiUrl . '/login/', [
                'json' => [
                    'nombre_usuario' => $username,
                    'contrasena' => $password
                ]
            ]);

            return json_decode($response->getBody(), true);

        } catch (GuzzleException $e) {
            // Maneja el error apropiadamente
            return ['error' => $e->getMessage()];
        }
    }

    public function getUserInfo($token)
    {
        try {
            $response = $this->client->get($this->apiUrl . '/user-info/', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            // Maneja el error apropiadamente
            return ['error' => $e->getMessage()];
        }
    }
    public function getRutaLectura($usuarioId, $token)
    {
        try {
            $response = $this->client->get($this->apiUrl . "/ruta_lectura/{$usuarioId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function obtenerRutas($token)
    {
        try {
            $response = $this->client->get($this->apiUrl . "/obtenerRutas/", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function asignarRuta($usuarioId, $rutaId, $token)
    {
        try {
            $response = $this->client->post($this->apiUrl . "/asignarRuta/", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'usuario_id' => $usuarioId,
                    'ruta_id' => $rutaId
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }


    public function obtenerRutaUsuario($usuarioId, $token)
    {
        try {
            $response = $this->client->get($this->apiUrl . "/usuario_ruta/{$usuarioId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function obtenerUsuarios($token)
    {
        try {
            $response = $this->client->get($this->apiUrl . "/obtenerUsuarios/", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
    public function obtenerAsignaciones($token)
    {
        try {
            $response = $this->client->get($this->apiUrl . "/obtenerAsignaciones/", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function eliminarAsignacion($usuarioId, $token)
    {
        try {
            $response = $this->client->delete($this->apiUrl . "/eliminarAsignacion/", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'usuario_id' => $usuarioId
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
