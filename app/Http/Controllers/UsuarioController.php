<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblPY1;
use Illuminate\Http\JsonResponse;
use App\Traits\Paginates;

class UsuarioController extends Controller
{
    use Paginates;

    // Listar todos los usuarios con filtros y paginación
    public function index(Request $request): JsonResponse
    {
        $query = tblPY1::query();

        // Aplicar filtros
        if ($request->has('username')) {
            $query->where('username', 'like', '%' . $request->username . '%');
        }
        if ($request->has('cedula')) {
            $query->where('cedula', 'like', '%' . $request->cedula . '%');
        }
        if ($request->has('telefono')) {
            $query->where('telefono', 'like', '%' . $request->telefono . '%');
        }
        if ($request->has('tipo_sangre')) {
            $query->where('tipo_sangre', $request->tipo_sangre);
        }

        // Aplicar paginación
        $usuarios = $this->applyPagination($request, $query);

        return response()->json($usuarios, 200);
    }

    // Crear un nuevo usuario
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'username' => 'required|string|unique:tblPY1,username',
            'password' => 'required|string|min:6',
            'cedula' => 'required|string|unique:tblPY1,cedula',
            'telefono' => 'required|string',
            'tipo_sangre' => 'nullable|string',
        ]);

        // Encriptar la contraseña
        $validatedData['password'] = bcrypt($validatedData['password']);

        $usuario = tblPY1::create($validatedData);
        return response()->json($usuario, 201);
    }

    // Mostrar un usuario específico
    public function show($id): JsonResponse
    {
        $usuario = tblPY1::findOrFail($id);
        return response()->json($usuario, 200);
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id): JsonResponse
    {
        $user = tblPY1::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'sometimes|required|string|unique:tblPY1,username,' . $id . ',UserId',
            'password' => 'sometimes|required|string|min:6',
            'cedula' => 'sometimes|required|string|unique:tblPY1,cedula,' . $id . ',UserId',
            'telefono' => 'sometimes|required|string',
            'tipo_sangre' => 'nullable|string',
        ]);

        if ($request->has('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json($user, 200);
    }

    // Eliminar un usuario
    public function destroy($id): JsonResponse
    {
        $user = tblPY1::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.'], 200);
    }
}