<?php

namespace App\Http\Controllers;

use App\Models\tblarticulo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\Paginates;
use Illuminate\Support\Facades\Log;

class ArticuloController extends Controller
{
    use Paginates;

    // Listar todos los artículos con filtros y paginación
    public function index(Request $request): JsonResponse
    {
        try {
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
        } catch (\Exception $e) {
            Log::error('Error al listar artículos: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Crear un nuevo artículo
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'codigo_barras' => 'required|string|unique:tblarticulos,codigo_barras',
                'descripcion' => 'required|string',
                'fabricante' => 'required|string',
            ]);

            $articulo = tblarticulo::create($validatedData);
            return response()->json($articulo, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear artículo: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Mostrar un artículo específico
    public function show($id): JsonResponse
    {
        try {
            $articulo = tblarticulo::findOrFail($id);
            return response()->json($articulo, 200);
        } catch (\Exception $e) {
            Log::error('Error al mostrar artículo: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Actualizar un artículo existente
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $articulo = tblarticulo::findOrFail($id);

            $validatedData = $request->validate([
                'codigo_barras' => 'sometimes|required|string|unique:tblarticulos,codigo_barras,' . $id . ',ArticuloId',
                'descripcion' => 'sometimes|required|string',
                'fabricante' => 'sometimes|required|string',
            ]);

            $articulo->update($validatedData);

            return response()->json($articulo, 200);
        } catch (\Exception $e) {
            Log::error('Error al actualizar artículo: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Eliminar un artículo
    public function destroy($id): JsonResponse
    {
        try {
            $articulo = tblarticulo::findOrFail($id);
            $articulo->delete();

            return response()->json(['message' => 'Artículo eliminado correctamente.'], 204);
        } catch (\Exception $e) {
            Log::error('Error al eliminar artículo: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}