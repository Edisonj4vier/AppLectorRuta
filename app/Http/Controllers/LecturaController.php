<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturaController extends Controller
{
    //
    public function index()
    {
        // Aquí puedes agregar la lógica para obtener los datos necesarios
        $lecturas = []; // Reemplaza esto con la lógica real para obtener las lecturas
        $mes = 'Enero 2024'; // Puedes hacer esto dinámico
        return view('lecturas.index', compact('lecturas', 'mes'));
    }

}
