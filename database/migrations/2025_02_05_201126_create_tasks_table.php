<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Columna autoincremental 'id'
            $table->string('title'); // Título de la tarea
            $table->text('description'); // Descripción de la tarea
            $table->enum('status', ['PENDIENTE', 'REALIZADA']); // Estado de la tarea (pendiente/realizada)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relación con la tabla 'users'
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
