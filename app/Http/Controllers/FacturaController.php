<?php

namespace App\Http\Controllers;

use App\Models\tblfactura;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FacturaController extends Controller
{
    // Listar todas las facturas
    public function index(): JsonResponse
    {
        $facturas = tblfactura::all();
        return response()->json($facturas, 200);
    }

    // Crear una nueva factura
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'PedidoId' => 'required|exists:tblpedido,PedidoId',
            'monto_total' => 'required|numeric',
            'fecha_emision' => 'required|date',
        ]);

        $factura = tblfactura::create($validatedData);
        return response()->json($factura, 201);
    }

    // Mostrar una factura específica
    public function show($id): JsonResponse
    {
        $factura = tblfactura::findOrFail($id);
        return response()->json($factura, 200);
    }

    // Actualizar una factura existente
    public function update(Request $request, $id): JsonResponse
    {
        $factura = tblfactura::findOrFail($id);

        $validatedData = $request->validate([
            'PedidoId' => 'sometimes|required|exists:tblpedido,PedidoId',
            'monto_total' => 'sometimes|required|numeric',
            'fecha_emision' => 'sometimes|required|date',
        ]);

        $factura->update($validatedData);

        return response()->json($factura, 200);
    }

    // Eliminar una factura
    public function destroy($id): JsonResponse
    {
        $factura = tblfactura::findOrFail($id);
        $factura->delete();

        return response()->json(['message' => 'Factura eliminada correctamente.'], 200);
    }
}
