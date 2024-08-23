<?php

namespace App\Http\Controllers;

use App\Models\tblcolocacion;
use Illuminate\Http\Request;

class ColocacionController extends Controller
{
    // Listar todas las colocaciones
    public function index()
    {
        return tblcolocacion::with('articulo')->get();
    }

    // Crear una nueva colocación
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'ArticuloId' => 'required|exists:tblArticulo,ArticuloId',
        ]);

        return tblcolocacion::create($validatedData);
    }

    // Mostrar una colocación específica
    public function show($id)
    {
        return tblcolocacion::with('articulo')->findOrFail($id);
    }

    // Actualizar una colocación existente
    public function update(Request $request, $id)
    {
        $colocacion = tblcolocacion::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string',
            'precio' => 'sometimes|required|numeric',
            'ArticuloId' => 'sometimes|required|exists:tblArticulo,ArticuloId',
        ]);

        $colocacion->update($validatedData);

        return $colocacion;
    }

    // Eliminar una colocación
    public function destroy($id)
    {
        $colocacion = tblcolocacion::findOrFail($id);
        $colocacion->delete();

        return response()->json(['message' => 'Colocación eliminada correctamente.']);
    }
}

