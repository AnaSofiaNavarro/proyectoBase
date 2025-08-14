<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CrearVsecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW vsecciones AS select
            secciones.idseccion AS idseccion,
            secciones.fkapartado AS fkapartado,
            apartados.apartado AS apartado,
            secciones.seccion AS seccion,
            secciones.seccionen AS seccionen,
            secciones.slug AS slug,
            secciones.descripcion AS descripcion,
            secciones.descripcionen AS descripcionen,
            secciones.orden AS orden,
            secciones.activo AS activo
            from
            (secciones
            left join apartados on ((secciones.fkapartado = apartados.idapartado)));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vsecciones");
    }
}