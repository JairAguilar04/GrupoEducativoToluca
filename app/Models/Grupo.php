<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $fillable = [
        'grado_id',
        'nombre',
        'turno',
        'capacidad',
        'finalizado',
        'fecha_inicio',
        'fecha_fin',
    ];
}
