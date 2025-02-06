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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Columna autoincremental 'id'
            $table->string('username')->unique(); // Nombre de usuario único
            $table->string('password'); // Contraseña
            $table->string('email')->unique(); // Correo electrónico único
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
