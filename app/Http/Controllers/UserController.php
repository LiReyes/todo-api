<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Muestra una lista de usuarios.
     *
     * Este método aplica filtros y ordenamientos a la consulta de usuarios,
     * y devuelve una colección de recursos de usuario.
     */
    public function index()
    {
        $users = User::filter()->sort()->getOrPaginate();
        return UserResource::collection($users);
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * Este método recibe un objeto de tipo UserRequest, que contiene las reglas de validación
     * para los campos del usuario. Si la validación es exitosa, se crea un nuevo usuario
     * y se devuelve un recurso de usuario con el código de estado 201.
     */
    public function store(UserRequest $request)
    {
        $user = new User();

        $user->username = $request->UserUsername;
        $user->password = bcrypt($request->UserPassword);
        $user->email = $request->UserEmail;

        try{
            $user->save();
            return response()->json([
                'message' => 'Usuario creado correctamente',
                'data' => UserResource::make($user)
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al guardar el usuario'], 500);
        }
    }

    /**
     * Muestra un usuario específico.
     *
     * Este método recibe un objeto de tipo User, que contiene la información del usuario
     * solicitado. Se devuelve un recurso de usuario con la información del usuario.
     */
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    /**
     * Actualiza un usuario específico.
     *
     * Este método recibe un objeto de tipo UserRequest, que contiene las reglas de validación
     * para los campos del usuario. Si la validación es exitosa, se actualiza el usuario
     * y se devuelve un recurso de usuario con el código de estado 200.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->username = $request->UserUsername ?? $user->username;
        $user->password = bcrypt($request->UserPassword) ?? $user->password;
        $user->email = $request->UserEmail ?? $user->email;

        try {
            $user->save();
            return response()->json([
                'message' => 'Usuario actualizado correctamente',
                'data' => UserResource::make($user)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el usuario'], 500);
        }
    }

    /**
     * Elimina un usuario específico.
     *
     * Este método recibe un objeto de tipo User, que contiene la información del usuario
     * a eliminar. Si la eliminación es exitosa, se devuelve un mensaje con el código de estado 200.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el usuario'], 500);
        }
    }
}
