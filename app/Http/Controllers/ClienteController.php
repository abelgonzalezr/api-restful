<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblcliente;
use Illuminate\Http\JsonResponse;
use App\Traits\Paginates;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    use Paginates;

    // Listar todos los clientes con filtros y paginación
    public function index(Request $request): JsonResponse
    {
        try {
            $query = tblcliente::query();

            // Aplicar filtros
            if ($request->has('nombre')) {
                $query->where('nombre', 'like', '%' . $request->nombre . '%');
            }
            if ($request->has('telefono')) {
                $query->where('telefono', 'like', '%' . $request->telefono . '%');
            }
            if ($request->has('tipo_cliente')) {
                $query->where('tipo_cliente', $request->tipo_cliente);
            }

            // Aplicar paginación
            $clientes = $this->applyPagination($request, $query);

            return response()->json($clientes, 200);
        } catch (\Exception $e) {
            Log::error('Error al listar clientes: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Crear un nuevo cliente
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'telefono' => 'required|string|unique:tblclientes,telefono|max:20',
                'tipo_cliente' => 'required|string|in:regular,vip,nuevo',
            ]);

            $cliente = tblcliente::create($validatedData);
            return response()->json($cliente, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Mostrar un cliente específico
    public function show($id): JsonResponse
    {
        try {
            $cliente = tblcliente::findOrFail($id);
            return response()->json($cliente, 200);
        } catch (\Exception $e) {
            Log::error('Error al mostrar cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Actualizar un cliente existente
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $cliente = tblcliente::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'sometimes|required|string|max:255',
                'telefono' => 'sometimes|required|string|unique:tblclientes,telefono,' . $id . ',ClienteId|max:20',
                'tipo_cliente' => 'sometimes|required|string|in:regular,vip,nuevo',
            ]);

            $cliente->update($validatedData);

            return response()->json($cliente, 200);
        } catch (\Exception $e) {
            Log::error('Error al actualizar cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    // Eliminar un cliente
    public function destroy($id): JsonResponse
    {
        try {
            $cliente = tblcliente::findOrFail($id);
            $cliente->delete();

            return response()->json(['message' => 'Cliente eliminado correctamente.'], 204);
        } catch (\Exception $e) {
            Log::error('Error al eliminar cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}