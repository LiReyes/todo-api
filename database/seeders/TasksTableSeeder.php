<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TasksTableSeeder extends Seeder
{
    /**
     * Seeder para la tabla de tareas.
     * 
     * Este seeder obtiene todos los usuarios y para cada uno de ellos genera un número aleatorio de tareas (entre 1 y 10).
     * Cada tarea tiene un título, una descripción, un estado (alternando entre 'pendiente' y 'completada') y se asigna al usuario actual.
     * 
     * @return void
     */
    public function run(): void
    {

        // Obtener todos los usuarios
        $users = User::all();

        foreach ($users as $user) {
            // Generar un número aleatorio entre 0 y 2
            $taskCount = rand(1, 10);

            for ($i = 0; $i < $taskCount; $i++) {
                Task::create([
                    'title' => 'Task ' . ($i + 1),
                    'description' => 'This is task ' . ($i + 1) . ' for user ' . $user->username . '.',
                    'status' => $i % 2 == 0 ? 'PENDIENTE' : 'REALIZADA', // Alterna entre pendiente y completada
                    'user_id' => $user->id, // Asigna la tarea al usuario actual
                ]);
            }
        }
    }
}
