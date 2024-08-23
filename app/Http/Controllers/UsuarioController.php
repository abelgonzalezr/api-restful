<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblPY1;

class UsuarioController extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        return TblPY1::all();
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|unique:tblPY1,username',
            'password' => 'required|string',
            'cedula' => 'required|string|unique:tblPY1,cedula',
            'telefono' => 'required|string',
            'tipo_sangre' => 'nullable|string',
        ]);

        // Encriptar la contraseña
        $validatedData['password'] = bcrypt($validatedData['password']);

        return TblPY1::create($validatedData);
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        return TblPY1::findOrFail($id);
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        $user = TblPY1::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'sometimes|required|string|unique:tblPY1,username,' . $id . ',UserId',
            'password' => 'sometimes|required|string',
            'cedula' => 'sometimes|required|string|unique:tblPY1,cedula,' . $id . ',UserId',
            'telefono' => 'sometimes|required|string',
            'tipo_sangre' => 'nullable|string',
        ]);

        if ($request->has('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        return $user;
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = TblPY1::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }
}
