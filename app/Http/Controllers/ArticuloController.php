<?php

namespace App\Http\Controllers;

use App\Models\tblarticulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    // Listar todos los artículos
    public function index()
    {
        return tblarticulo::all();
    }

    // Crear un nuevo artículo
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo_barras' => 'required|string|unique:tblArticulo,codigo_barras',
            'descripcion' => 'required|string',
            'fabricante' => 'required|string',
        ]);

        return tblarticulo::create($validatedData);
    }

    // Mostrar un artículo específico
    public function show($id)
    {
        return tblarticulo::findOrFail($id);
    }

    // Actualizar un artículo existente
    public function update(Request $request, $id)
    {
        $articulo = tblarticulo::findOrFail($id);

        $validatedData = $request->validate([
            'codigo_barras' => 'sometimes|required|string|unique:tblArticulo,codigo_barras,' . $id . ',ArticuloId',
            'descripcion' => 'sometimes|required|string',
            'fabricante' => 'sometimes|required|string',
        ]);

        $articulo->update($validatedData);

        return $articulo;
    }

    // Eliminar un artículo
    public function destroy($id)
    {
        $articulo = tblarticulo::findOrFail($id);
        $articulo->delete();

        return response()->json(['message' => 'Artículo eliminado correctamente.']);
    }
}
