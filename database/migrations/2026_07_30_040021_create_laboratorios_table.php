// database/migrations/2026_01_01_000001_create_laboratorios_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('ubicacion', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laboratorios');
    }
};
