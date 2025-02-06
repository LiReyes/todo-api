<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
        $taskData = [];
    
        // Recorrer el array y agregar el prefijo 'Task' a cada clave
        foreach ($data as $key => $value) {
            // Agregar el prefijo 'Task' a cada clave y vuelve MAYÚSCULA la primera letra
            $taskData['Task' . ucfirst($key)] = $value;
        }

        // Eliminar las no deseadas
        unset($taskData['TaskCreated_at']);
        unset($taskData['TaskUpdated_at']);
    
        return $taskData;
    }
}
