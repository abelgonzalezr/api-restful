<?php

namespace App\Http\Controllers;

use App\Models\tblcompra;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CompraController extends Controller
{
    // Listar todas las compras
    public function index(): JsonResponse
    {
        $compras = tblcompra::with(['cliente', 'colocacion'])->get();
        return response()->json($compras, 200);
    }

    // Crear una nueva compra
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'ClienteId' => 'required|exists:tblcliente,ClienteId',
            'ColocacionId' => 'required|exists:tblColocacion,ColocacionId',
            'cantidad' => 'required|integer|min:1',
        ]);

        $compra = tblcompra::create($validatedData);
        return response()->json($compra, 201);
    }

    // Mostrar una compra específica
    public function show($id): JsonResponse
    {
        $compra = tblcompra::with(['cliente', 'colocacion'])->findOrFail($id);
        return response()->json($compra, 200);
    }

    // Actualizar una compra existente
    public function update(Request $request, $id): JsonResponse
    {
        $compra = tblcompra::findOrFail($id);

        $validatedData = $request->validate([
            'ClienteId' => 'sometimes|required|exists:tblcliente,ClienteId',
            'ColocacionId' => 'sometimes|required|exists:tblColocacion,ColocacionId',
            'cantidad' => 'sometimes|required|integer|min:1',
        ]);

        $compra->update($validatedData);

        return response()->json($compra, 200);
    }

    // Eliminar una compra
    public function destroy($id): JsonResponse
    {
        $compra = tblcompra::findOrFail($id);
        $compra->delete();

        return response()->json(['message' => 'Compra eliminada correctamente.'], 200);
    }
}
