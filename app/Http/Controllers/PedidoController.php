<?php

namespace App\Http\Controllers;

use App\Models\tblpedido;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PedidoController extends Controller
{
    // Listar todos los pedidos
    public function index(): JsonResponse
    {
        $pedidos = tblpedido::all();
        return response()->json($pedidos, 200);
    }

    // Crear un nuevo pedido
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'ClienteId' => 'required|exists:tblclientes,ClienteId',
            'fecha' => 'required|date',
        ]);

        $pedido = tblpedido::create($validatedData);
        return response()->json($pedido, 201);
    }

    // Mostrar un pedido específico
    public function show($id): JsonResponse
    {
        $pedido = tblpedido::findOrFail($id);
        return response()->json($pedido, 200);
    }

    // Actualizar un pedido existente
    public function update(Request $request, $id): JsonResponse
    {
        $pedido = tblpedido::findOrFail($id);

        $validatedData = $request->validate([
            'ClienteId' => 'sometimes|required|exists:tblclientes,ClienteId',
            'fecha' => 'sometimes|required|date',
        ]);

        $pedido->update($validatedData);

        return response()->json($pedido, 200);
    }

    // Eliminar un pedido
    public function destroy($id): JsonResponse
    {
        $pedido = tblpedido::findOrFail($id);
        $pedido->delete();

        return response()->json(['message' => 'Pedido eliminado correctamente.'], 200);
    }
}
