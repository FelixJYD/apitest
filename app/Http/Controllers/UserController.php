<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Método para mostrar todos los usuarios
    public function index()
    {
        return User::all();
    }

    // Método para crear un nuevo usuario
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    // Método para mostrar un usuario específico
    public function show(User $user)
    {
        return $user;
    }

    // Método para actualizar un usuario
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user, 200);
    }

    // Método para eliminar un usuario
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
