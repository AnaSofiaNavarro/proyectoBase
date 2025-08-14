<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Validacionconstancia extends Model
{
    use HasFactory;
    protected $connection = 'mysql_ajuridico'; // Base de datos alternativa de asuntos juridicos
    protected $table = 'ws_consulta'; // Tabla principal
    protected $primaryKey = 'id_consult'; // Clave primaria correcta
    public $timestamps = false;
    protected $guarded = [];
}
