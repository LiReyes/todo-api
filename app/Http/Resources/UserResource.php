<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Obtén la data
        $data = parent::toArray($request); 

        // Array vacío para almacenar la data transformada
        $userData = [];

        // Recorrer el array y agregar el prefijo 'user' a cada clave
        foreach ($data as $key => $value) {
            // Agregar el prefijo 'User' a cada clave y vuelve MAYÚSCULA la primera letra
            $userData['User' . ucfirst($key)] = $value;
        }

        // Eliminar las no deseadas
        unset($userData['UserCreated_at']);
        unset($userData['UserUpdated_at']);

        return $userData;
    }
}
