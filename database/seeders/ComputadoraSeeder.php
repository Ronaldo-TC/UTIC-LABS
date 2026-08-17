<?php

namespace Database\Seeders;

use App\Models\Computadora;
use App\Models\Laboratorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComputadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar que existan laboratorios
        $laboratorios = Laboratorio::all();

        if ($laboratorios->isEmpty()) {
            $this->command->error('No hay laboratorios registrados. Primero ejecute el seeder de laboratorios.');
            return;
        }

        // Datos de ejemplo para computadoras
        $computadoras = [
            [
                'codigo_inventario' => 'PC-001',
                'marca' => 'Dell',
                'procesador' => 'Intel Core i7-10700',
                'ram_gb' => 16,
                'estado' => 'activo',
            ],
            [
                'codigo_inventario' => 'PC-002',
                'marca' => 'HP',
                'procesador' => 'AMD Ryzen 5 5600X',
                'ram_gb' => 8,
                'estado' => 'activo',
            ],
            [
                'codigo_inventario' => 'PC-003',
                'marca' => 'Lenovo',
                'procesador' => 'Intel Core i5-11400',
                'ram_gb' => 12,
                'estado' => 'mantenimiento',
            ],
            [
                'codigo_inventario' => 'PC-004',
                'marca' => 'Asus',
                'procesador' => 'AMD Ryzen 7 5800X',
                'ram_gb' => 32,
                'estado' => 'activo',
            ],
            [
                'codigo_inventario' => 'PC-005',
                'marca' => 'Dell',
                'procesador' => 'Intel Core i9-10900K',
                'ram_gb' => 64,
                'estado' => 'activo',
            ],
            [
                'codigo_inventario' => 'PC-006',
                'marca' => 'HP',
                'procesador' => 'Intel Core i5-10400',
                'ram_gb' => 8,
                'estado' => 'baja',
            ],
            [
                'codigo_inventario' => 'PC-007',
                'marca' => 'Lenovo',
                'procesador' => 'AMD Ryzen 3 3200G',
                'ram_gb' => 8,
                'estado' => 'mantenimiento',
            ],
            [
                'codigo_inventario' => 'PC-008',
                'marca' => 'Acer',
                'procesador' => 'Intel Core i3-10100',
                'ram_gb' => 4,
                'estado' => 'activo',
            ],
            [
                'codigo_inventario' => 'PC-009',
                'marca' => 'Dell',
                'procesador' => 'Intel Core i7-11700K',
                'ram_gb' => 16,
                'estado' => 'activo',
            ],
            [
                'codigo_inventario' => 'PC-010',
                'marca' => 'HP',
                'procesador' => 'AMD Ryzen 9 5900X',
                'ram_gb' => 32,
                'estado' => 'activo',
            ],
            [
                'codigo_inventario' => 'PC-011',
                'marca' => 'Asus',
                'procesador' => 'Intel Core i5-11600K',
                'ram_gb' => 16,
                'estado' => 'mantenimiento',
            ],
            [
                'codigo_inventario' => 'PC-012',
                'marca' => 'MSI',
                'procesador' => 'AMD Ryzen 7 5700G',
                'ram_gb' => 16,
                'estado' => 'activo',
            ],
        ];

        // Insertar las computadoras
        foreach ($computadoras as $computadoraData) {
            // Asignar un laboratorio aleatorio
            $laboratorio = $laboratorios->random();

            Computadora::create([
                'laboratorio_id' => $laboratorio->id,
                'codigo_inventario' => $computadoraData['codigo_inventario'],
                'marca' => $computadoraData['marca'],
                'procesador' => $computadoraData['procesador'],
                'ram_gb' => $computadoraData['ram_gb'],
                'estado' => $computadoraData['estado'],
            ]);
        }

        $this->command->info('Se han creado ' . count($computadoras) . ' computadoras de prueba.');
    }
}
