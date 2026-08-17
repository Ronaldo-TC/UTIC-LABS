// database/migrations/2026_01_01_000002_create_computadoras_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('computadoras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorio_id')->constrained('laboratorios')->onDelete('restrict');
            $table->string('codigo_inventario', 50)->unique();
            $table->string('marca', 50);
            $table->string('procesador', 50);
            $table->integer('ram_gb');
            $table->enum('estado', ['activo', 'mantenimiento', 'baja'])->default('activo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computadoras');
    }
};
