<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblcliente;

class ClienteController extends Controller
{
    // Listar todos los clientes
    public function index()
    {
        return tblcliente::all();
    }

    // Crear un nuevo cliente
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'telefono' => 'required|string|unique:tblcliente,telefono',
            'tipo_cliente' => 'required|string',
        ]);

        return tblcliente::create($validatedData);
    }

    // Mostrar un cliente específico
    public function show($id)
    {
        return tblcliente::findOrFail($id);
    }

    // Actualizar un cliente existente
    public function update(Request $request, $id)
    {
        $cliente = tblcliente::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string',
            'telefono' => 'sometimes|required|string|unique:tblcliente,telefono,' . $id . ',ClienteId',
            'tipo_cliente' => 'sometimes|required|string',
        ]);

        $cliente->update($validatedData);

        return $cliente;
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        $cliente = tblcliente::findOrFail($id);
        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado correctamente.']);
    }
}
