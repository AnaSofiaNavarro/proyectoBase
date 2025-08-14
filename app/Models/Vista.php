<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vista extends Model
{
    use HasFactory;

    protected $table = 'vistas';
    protected $primaryKey = 'idvista';
    //By CIRG para deshabilitar los campos created_at y updated_at
    public $timestamps = false;
}
