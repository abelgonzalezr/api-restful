<?php

namespace App\Http\Controllers;

use App\Models\tblfactura;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\Paginates;
use Illuminate\Support\Facades\Log;

class FacturaController extends Controller
{
    use Paginates;

    // Listar todas las facturas con filtros y paginación
    public function index(Request $request): JsonResponse
    {
        try {
            $query = tblfactura::query();

            // Aplicar filtros
            if ($request->has('PedidoId')) {
                $query->where('PedidoId', $request->PedidoId);
            }
            if ($request->has('monto_min')) {
                $query->where('monto_total', '>=', $request->monto_min);
            }
            if ($request->has('monto_max')) {
                $query->where('monto_total', '<=', $request->monto_max);
            }
            if ($request->has('fecha_desde')) {
                $query->where('fecha_emision', '>=', $request->fecha_desde);
            }
            if ($request->has('fecha_hasta')) {
                $query->where('fecha_emision', '<=', $request->fecha_hasta);
            }

            // Aplicar paginación
            $facturas = $this->applyPagination($request, $query);

            return response()->json($facturas, 200);
        } catch (\Exception $e) {
            Log::error('Error al listar facturas: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Crear una nueva factura
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'PedidoId' => 'required|exists:tblpedido,PedidoId',
                'monto_total' => 'required|numeric',
                'fecha_emision' => 'required|date',
            ]);

            $factura = tblfactura::create($validatedData);
            return response()->json($factura, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear factura: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Mostrar una factura específica
    public function show($id): JsonResponse
    {
        try {
            $factura = tblfactura::findOrFail($id);
            return response()->json($factura, 200);
        } catch (\Exception $e) {
            Log::error('Error al mostrar factura: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Actualizar una factura existente
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $factura = tblfactura::findOrFail($id);

            $validatedData = $request->validate([
                'PedidoId' => 'sometimes|required|exists:tblpedido,PedidoId',
                'monto_total' => 'sometimes|required|numeric',
                'fecha_emision' => 'sometimes|required|date',
            ]);

            $factura->update($validatedData);

            return response()->json($factura, 200);
        } catch (\Exception $e) {
            Log::error('Error al actualizar factura: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Eliminar una factura
    public function destroy($id): JsonResponse
    {
        try {
            $factura = tblfactura::findOrFail($id);
            $factura->delete();

            return response()->json(['message' => 'Factura eliminada correctamente.'], 204);
        } catch (\Exception $e) {
            Log::error('Error al eliminar factura: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}