<?php

namespace App\Http\Controllers;

use App\Models\tblcolocacion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ColocacionController extends Controller
{
    // Listar todas las colocaciones
    public function index(): JsonResponse
    {
        $colocaciones = tblcolocacion::with('articulo')->get();
        return response()->json($colocaciones, 200);
    }

    // Crear una nueva colocación
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'ArticuloId' => 'required|exists:tblArticulo,ArticuloId',
        ]);

        $colocacion = tblcolocacion::create($validatedData);
        return response()->json($colocacion, 201);
    }

    // Mostrar una colocación específica
    public function show($id): JsonResponse
    {
        $colocacion = tblcolocacion::with('articulo')->findOrFail($id);
        return response()->json($colocacion, 200);
    }

    // Actualizar una colocación existente
    public function update(Request $request, $id): JsonResponse
    {
        $colocacion = tblcolocacion::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'precio' => 'sometimes|required|numeric|min:0',
            'ArticuloId' => 'sometimes|required|exists:tblArticulo,ArticuloId',
        ]);

        $colocacion->update($validatedData);

        return response()->json($colocacion, 200);
    }

    // Eliminar una colocación
    public function destroy($id): JsonResponse
    {
        $colocacion = tblcolocacion::findOrFail($id);
        $colocacion->delete();

        return response()->json(['message' => 'Colocación eliminada correctamente.'], 200);
    }
}
