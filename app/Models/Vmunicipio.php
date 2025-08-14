<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vmunicipio extends Model
{
    use HasFactory;

    protected $table = 'vmunicipios';
    protected $primaryKey = 'idmunicipio';
    //By CIRG para deshabilitar los campos created_at y updated_at
    public $timestamps = false;
}