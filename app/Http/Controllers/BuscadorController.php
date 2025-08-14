<?php

namespace App\Http\Controllers;

use App\Models\Contenidoanexo;
use App\Models\Vcontenido;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

public function buscar(Request $request)
{
    $query = $request->input('q');

    // 1. Buscar en contenidos
    $contenidos = Vcontenido::where('activo', 1)
        ->where(function ($qBuilder) use ($query) {
            $qBuilder->where('encabezado', 'LIKE', "%$query%")
                     ->orWhere('subtitulo', 'LIKE', "%$query%")
                     ->orWhere('descripcion', 'LIKE', "%$query%")
                     ->orWhere('url', 'LIKE', "%$query%");
        })
        ->get()
        ->map(function ($contenido) {
            $contenido->tipo_resultado = 'contenido';
            return $contenido;
        });

    // 2. Buscar en anexos con relación al contenido
    $anexos = Contenidoanexo::with('contenido')
        ->where('activo', 1)
        ->where(function ($q) use ($query) {
            $q->where('descripcion', 'LIKE', "%$query%")
              ->orWhere('archivo', 'LIKE', "%$query%");
        })
        ->get()
        ->map(function ($anexo) {
            $anexo->tipo_resultado = 'anexo';
            return $anexo;
        });

    // 3. Combinar, ordenar por fecha (si aplica) y paginar
    $resultados = $contenidos->concat($anexos)->sortByDesc(function ($item) {
        return $item->fecha ?? optional($item->contenido)->fecha;
    })->values();

    // 4. Paginar manualmente
    $perPage = 10;
    $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
    $currentItems = $resultados->slice(($currentPage - 1) * $perPage, $perPage)->values();

    $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentItems,
        $resultados->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );
    // dd($resultados);
    return view('busqueda.resultados', [
        'resultados' => $paginated,
        'query' => $query
    ]);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}