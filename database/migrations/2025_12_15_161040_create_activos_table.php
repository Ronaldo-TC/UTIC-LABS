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
        Schema::create('activos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('descrip');
            $table->decimal('precio', 10, 2);
            $table->date('fecha');
            $table->enum('estado', ['activo', 'inactivo', 'mantenimiento', 'baja'])->default('activo');
            $table->string('foto')->nullable();
            $table->foreignId('grupos_id')->constrained('grupos')->onDelete('cascade');
            $table->foreignId('oficinas_id')->constrained('oficinas')->onDelete('cascade');
            $table->foreignId('responsables_id')->constrained('responsables')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activos');
    }
};
