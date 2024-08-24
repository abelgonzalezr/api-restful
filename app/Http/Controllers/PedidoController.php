<?php

namespace App\Http\Controllers;

use App\Models\tblpedido;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\Paginates;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    use Paginates;

    // Listar todos los pedidos con filtros y paginación
    public function index(Request $request): JsonResponse
    {
        try {
            $query = tblpedido::query();

            // Aplicar filtros
            if ($request->has('ClienteId')) {
                $query->where('ClienteId', $request->ClienteId);
            }
            if ($request->has('fecha_desde')) {
                $query->where('fecha', '>=', $request->fecha_desde);
            }
            if ($request->has('fecha_hasta')) {
                $query->where('fecha', '<=', $request->fecha_hasta);
            }

            // Aplicar paginación
            $pedidos = $this->applyPagination($request, $query);

            return response()->json($pedidos, 200);
        } catch (\Exception $e) {
            Log::error('Error al listar pedidos: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Crear un nuevo pedido
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'ClienteId' => 'required|exists:tblclientes,ClienteId',
                'fecha' => 'required|date',
            ]);

            $pedido = tblpedido::create($validatedData);
            return response()->json($pedido, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear pedido: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Mostrar un pedido específico
    public function show($id): JsonResponse
    {
        try {
            $pedido = tblpedido::findOrFail($id);
            return response()->json($pedido, 200);
        } catch (\Exception $e) {
            Log::error('Error al mostrar pedido: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Actualizar un pedido existente
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $pedido = tblpedido::findOrFail($id);

            $validatedData = $request->validate([
                'ClienteId' => 'sometimes|required|exists:tblclientes,id',
                'fecha' => 'sometimes|required|date',
            ]);

            $pedido->update($validatedData);

            return response()->json($pedido, 200);
        } catch (\Exception $e) {
            Log::error('Error al actualizar pedido: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Eliminar un pedido
    public function destroy($id): JsonResponse
    {
        try {
            $pedido = tblpedido::findOrFail($id);
            $pedido->delete();

            return response()->json(['message' => 'Pedido eliminado correctamente.'], 200);
        } catch (\Exception $e) {
            Log::error('Error al eliminar pedido: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}