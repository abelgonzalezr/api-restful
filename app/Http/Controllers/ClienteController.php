<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblcliente;
use Illuminate\Http\JsonResponse;
use App\Traits\Paginates;

class ClienteController extends Controller
{
    use Paginates;

    // Listar todos los clientes con filtros y paginación
    public function index(Request $request): JsonResponse
    {
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
    }

    // Crear un nuevo cliente
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|unique:tblcliente,telefono|max:20',
            'tipo_cliente' => 'required|string|in:regular,vip,nuevo',
        ]);

        $cliente = tblcliente::create($validatedData);
        return response()->json($cliente, 201);
    }

    // Mostrar un cliente específico
    public function show($id): JsonResponse
    {
        $cliente = tblcliente::findOrFail($id);
        return response()->json($cliente, 200);
    }

    // Actualizar un cliente existente
    public function update(Request $request, $id): JsonResponse
    {
        $cliente = tblcliente::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string|unique:tblcliente,telefono,' . $id . ',ClienteId|max:20',
            'tipo_cliente' => 'sometimes|required|string|in:regular,vip,nuevo',
        ]);

        $cliente->update($validatedData);

        return response()->json($cliente, 200);
    }

    // Eliminar un cliente
    public function destroy($id): JsonResponse
    {
        $cliente = tblcliente::findOrFail($id);
        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado correctamente.'], 200);
    }
}