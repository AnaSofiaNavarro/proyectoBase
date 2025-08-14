<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipocontenido;

class TipocontenidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipocontenido::create(['tipocontenido' => 'Contenido', 'activo' => true]);
        Tipocontenido::create(['tipocontenido' => 'Aechivo', 'activo' => true]);
        Tipocontenido::create(['tipocontenido' => 'Enlace', 'activo' => true]);
    }
}