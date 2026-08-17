<?php

namespace Database\Seeders;

use App\Models\Laboratorio;
use Illuminate\Database\Seeder;

class LaboratorioSeeder extends Seeder
{
    public function run(): void
    {
        $laboratorios = [
            [
                'nombre' => 'Laboratorio de Cómputo 1',
                'ubicacion' => 'Edificio A, Planta Baja',
            ],
            [
                'nombre' => 'Laboratorio de Cómputo 2',
                'ubicacion' => 'Edificio A, Planta Alta',
            ],
            [
                'nombre' => 'Laboratorio de Redes',
                'ubicacion' => 'Edificio B, Piso 1',
            ],
            [
                'nombre' => 'Laboratorio de Desarrollo',
                'ubicacion' => 'Edificio B, Piso 2',
            ],
        ];

        foreach ($laboratorios as $laboratorio) {
            Laboratorio::create($laboratorio);
        }

        $this->command->info('Laboratorios creados exitosamente.');
    }
}
