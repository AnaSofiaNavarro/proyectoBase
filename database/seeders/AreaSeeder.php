<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Area::create(['nombre' => 'presidencia', 'orden' => 1, 'activo' => 1]);
        Area::create(['nombre' => 'Consejo de la Judicatura', 'orden' => 2, 'activo' => 1]);
        Area::create(['nombre' => 'Coordinación de Visitaduría', 'orden' => 3, 'activo' => 1]);
        Area::create(['nombre' => 'Primera Sala Regional Colegiada en Materia Civil, Zona 01 Tuxtla', 'orden' => 4, 'activo' => 1]);
        Area::create(['nombre' => 'Pleno de Distrito del Tribunal Superior de Justicia del Poder Judicial del Estado', 'orden' => 5, 'activo' => 1]);
        Area::create(['nombre' => 'Segunda Sala Regional Colegiada en Materia Civil, Zona 01 Tuxtla', 'orden' => 6, 'activo' => 1]);
        Area::create(['nombre' => 'Primer Tribunal de Alzada en Materia Penal, Zona 01 Tuxtla', 'orden' => 7, 'activo' => 1]);
    }
}
