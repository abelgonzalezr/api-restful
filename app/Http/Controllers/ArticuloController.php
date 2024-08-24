<?php

namespace App\Http\Controllers;

use App\Models\tblarticulo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\Paginates;

class ArticuloController extends Controller
{
    use Paginates;

    // Listar todos los artículos con filtros y paginación
    public function index(Request $request): JsonResponse
    {
        $query = tblarticulo::query();

        // Aplicar filtros
        if ($request->has('codigo_barras')) {
            $query->where('codigo_barras', 'like', '%' . $request->codigo_barras . '%');
        }
        if ($request->has('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->descripcion . '%');
        }
        if ($request->has('fabricante')) {
            $query->where('fabricante', 'like', '%' . $request->fabricante . '%');
        }

        // Aplicar paginación
        $articulos = $this->applyPagination($request, $query);

        return response()->json($articulos, 200);
    }

    // Crear un nuevo artículo
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'codigo_barras' => 'required|string|unique:tblArticulo,codigo_barras',
            'descripcion' => 'required|string',
            'fabricante' => 'required|string',
        ]);

        $articulo = tblarticulo::create($validatedData);
        return response()->json($articulo, 201);
    }

    // Mostrar un artículo específico
    public function show($id): JsonResponse
    {
        $articulo = tblarticulo::findOrFail($id);
        return response()->json($articulo, 200);
    }

    // Actualizar un artículo existente
    public function update(Request $request, $id): JsonResponse
    {
        $articulo = tblarticulo::findOrFail($id);

        $validatedData = $request->validate([
            'codigo_barras' => 'sometimes|required|string|unique:tblArticulo,codigo_barras,' . $id . ',ArticuloId',
            'descripcion' => 'sometimes|required|string',
            'fabricante' => 'sometimes|required|string',
        ]);

        $articulo->update($validatedData);

        return response()->json($articulo, 200);
    }

    // Eliminar un artículo
    public function destroy($id): JsonResponse
    {
        $articulo = tblarticulo::findOrFail($id);
        $articulo->delete();

        return response()->json(['message' => 'Artículo eliminado correctamente.'], 200);
    }
}