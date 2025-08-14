<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vconfiguracionanexo extends Model
{
    use HasFactory;

    protected $table = 'vconfiguracionanexos';
    protected $primaryKey = 'idanexo';
    //By CIRG para deshabilitar los campos created_at y updated_at
    public $timestamps = false;
}
