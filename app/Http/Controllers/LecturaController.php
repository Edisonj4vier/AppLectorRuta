<?php

namespace App\Http\Controllers;

use App\Models\AapMovilLectura;
use App\Models\AapLectura;
use App\Models\Acometida;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LecturaController extends Controller
{
    public function index()
    {
        $lecturas = $this->obtenerLecturasConPromedio();
        $mes = date('m'); // Mes actual
        return view('lecturas.index', compact('lecturas', 'mes'));
    }
    private function obtenerLecturasConPromedio()
    {
        return DB::select('SELECT * FROM vista_lecturas_con_promedio');
    }
    public function update(Request $request, $id)
    {
        $lectura = AapMovilLectura::findOrFail($id);
        $lectura->update([
            'lectura' => $request->lectura,
            'observacion' => $request->observacion
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $lectura = AapMovilLectura::findOrFail($id);
        $lectura->delete();

        return response()->json(['success' => true]);
    }
    private function getData()
    {
        $aapMovilLectura = AapMovilLectura::select(
            'cuenta', 'medidor', 'clave', 'abonado', 'lectura', 'observacion'
        )->get();

        $aapLectura = AapLectura::select(
            'numcuenta as cuenta', 'nromedidor as medidor', 'lectura', 'observacion',
            'anio as año', 'mes', 'consumo as promedio'
        )->get();

        $acometidas = Acometida::select(
            'numcuenta as cuenta', 'no_medidor as medidor', 'clave', 'ruta'
        )->get();

        $data = new Collection();

        foreach ($aapMovilLectura as $lectura) {
            $acometida = $acometidas->where('cuenta', $lectura->cuenta)->first();
            $data->push([
                'cuenta' => $lectura->cuenta,
                'medidor' => $lectura->medidor,
                'clave' => $lectura->clave,
                'abonado' => $lectura->abonado,
                'ruta' => $acometida ? $acometida->ruta : '',
                'lectura' => $lectura->lectura,
                'promedio' => '',
                'observacion' => $lectura->observacion,
                'año' => '',
                'mes' => ''
            ]);
        }

        foreach ($aapLectura as $lectura) {
            $acometida = $acometidas->where('cuenta', $lectura->cuenta)->first();
            $data->push([
                'cuenta' => $lectura->cuenta,
                'medidor' => $lectura->medidor,
                'clave' => $acometida ? $acometida->clave : '',
                'abonado' => '',
                'ruta' => $acometida ? $acometida->ruta : '',
                'lectura' => $lectura->lectura,
                'promedio' => $lectura->promedio,
                'observacion' => $lectura->observacion,
                'año' => $lectura->año,
                'mes' => $lectura->mes
            ]);
        }

        return $data;
    }
}
