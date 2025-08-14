<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CrearVdirectorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW vdirectorios AS select
            directorios.iddirectorio AS iddirectorio,
            directorios.fkmunicipio AS fkmunicipio,
            municipios.municipio AS municipio,
            directorios.fkpadre AS fkpadre,
            directorios.area AS area,
            directorios.nombre AS nombre,
            directorios.paterno AS paterno,
            directorios.materno AS materno,
            concat(directorios.nombre, ' ', directorios.paterno, ' ', ifnull(directorios.materno, '')) AS nombrecompleto,
            directorios.direccion AS direccion,
            directorios.telefono AS telefono,
            directorios.fax AS fax,
            directorios.correo AS correo,
            directorios.latitud AS latitud,
            directorios.longitud AS longitud,
            directorios.orden AS orden,
            directorios.titular AS titular,
            directorios.mando AS mando,
            directorios.activo AS activo
            from
            (directorios
            left join municipios on ((directorios.fkmunicipio = municipios.idmunicipio)))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vdirectorios");
    }
}