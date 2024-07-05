<?php

namespace App\Http\Controllers;

use App\Models\ConsumoLectura;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ConsumoLecturaController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->filled('year') ? $request->year : null;
        $month = $request->filled('month') ? $request->month : null;
        $search = $request->filled('search') ? $request->search : null;

        $lecturas = DB::select("SELECT * FROM get_lecturas_combinadas(?, ?, ?)", [$year, $month, $search]);

        // Paginar los resultados manualmente
        $page = $request->get('page', 1);
        $perPage = 15;
        $items = new LengthAwarePaginator(
            array_slice($lecturas, ($page - 1) * $perPage, $perPage),
            count($lecturas),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('lecturas.index', ['lecturas' => $items]);
    }

    public function show($cuenta)
    {
        $consumo = ConsumoLectura::where('cuenta', $cuenta)->first();

        if (!$consumo) {
            return response()->json(['message' => 'Consumo no encontrado'], 404);
        }

        return response()->json($consumo);
    }
}
