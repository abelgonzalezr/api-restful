<?php

namespace App\Http\Controllers;

use App\Models\tblcompra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    // Listar todas las compras
    public function index()
    {
        return tblcompra::with(['cliente', 'colocacion'])->get();
    }

    // Crear una nueva compra
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ClienteId' => 'required|exists:tblcliente,ClienteId',
            'ColocacionId' => 'required|exists:tblColocacion,ColocacionId',
            'cantidad' => 'required|integer',
        ]);

        return tblcompra::create($validatedData);
    }

    // Mostrar una compra específica
    public function show($id)
    {
        return tblcompra::with(['cliente', 'colocacion'])->findOrFail($id);
    }

    // Actualizar una compra existente
    public function update(Request $request, $id)
    {
        $compra = tblcompra::findOrFail($id);

        $validatedData = $request->validate([
            'ClienteId' => 'sometimes|required|exists:tblcliente,ClienteId',
            'ColocacionId' => 'sometimes|required|exists:tblColocacion,ColocacionId',
            'cantidad' => 'sometimes|required|integer',
        ]);

        $compra->update($validatedData);

        return $compra;
    }

    // Eliminar una compra
    public function destroy($id)
    {
        $compra = tblcompra::findOrFail($id);
        $compra->delete();

        return response()->json(['message' => 'Compra eliminada correctamente.']);
    }
}

