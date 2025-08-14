<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenidoanexo extends Model
{
    use HasFactory;

    protected $table = 'contenidoanexos';
    protected $primaryKey = 'idanexo';
    //By CIRG para deshabilitar los campos created_at y updated_at
    public $timestamps = false;

    public function contenido()
{
    return $this->belongsTo(Vcontenido::class, 'fkcontenido', 'idcontenido');
}

}