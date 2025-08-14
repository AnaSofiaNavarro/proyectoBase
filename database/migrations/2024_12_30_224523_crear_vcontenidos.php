<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CrearVcontenidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW vcontenidos AS select
            contenidos.idcontenido AS idcontenido,
            (select contenidoanexos.imagen from contenidoanexos where ((contenidoanexos.activo = 1) and (contenidoanexos.fkcontenido = contenidos.idcontenido)) order by contenidoanexos.idanexo limit 1) AS imagen,
            (select contenidoanexos.descripcion from contenidoanexos where ((contenidoanexos.activo = 1) and (contenidoanexos.fkcontenido = contenidos.idcontenido)) order by contenidoanexos.idanexo limit 1) AS alt,
            vistas.fkapartado AS fkapartado,
            apartados.apartado AS apartado,
            apartados.apartadoen AS apartadoen,
            apartados.slug AS apartadoslug,
            vistas.fkseccion AS fkseccion,
            secciones.seccion AS seccion,
            secciones.seccionen AS seccionen,
            secciones.slug AS seccionslug,
            secciones.descripcion AS secciondescripcion,
            contenidos.fecha AS fecha,
            contenidos.encabezado AS encabezado,
            contenidos.encabezadoen AS encabezadoen,
            contenidos.slug AS contenidoslug,
            contenidos.subtitulo AS subtitulo,
            contenidos.subtituloen AS subtituloen,
            contenidos.descripcion AS descripcion,
            contenidos.descripcionen AS descripcionen,
            contenidos.fuente AS fuente,
            contenidos.telefono AS telefono,
            contenidos.extension AS extension,
            contenidos.correo AS correo,
            contenidos.fktipocontenido AS fktipocontenido,
            contenidos.archivo AS archivo,
            contenidos.url AS url,
            contenidos.target AS target,
            contenidos.relevante AS relevante,
            contenidos.orden AS orden,
            contenidos.fkusuario AS fkusuario,
            contenidos.activo AS activo,
            template AS template,
            vistas.idvista AS vista
            from
            (((contenidos
            left join vistas on ((contenidos.idcontenido = vistas.fkcontenido)))
            left join secciones on ((vistas.fkseccion = secciones.idseccion)))
            left join apartados on ((vistas.fkapartado = apartados.idapartado)))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vcontenidos");
    }
}