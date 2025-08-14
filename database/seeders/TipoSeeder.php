<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create(['tipo' => 'Imagen', 'anexo' => true, 'configuracion' => true]);
        Tipo::create(['tipo' => 'Video', 'anexo' => false, 'configuracion' => false]);
        Tipo::create(['tipo' => 'PDF', 'anexo' => true, 'configuracion' => false]);
        Tipo::create(['tipo' => 'YouTube', 'anexo' => true, 'configuracion' => false]);
    }
}