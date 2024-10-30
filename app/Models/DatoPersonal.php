<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatoPersonal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'datos_personales_usuarios';

    protected $fillable = [
        'usuario_id',
        'perfil_academico',
        'fecha_nacimiento',
        'curp',
        'edad',
        'sexo',
        'domicilio',
        'colonia',
        'localidad_municipio',
        'telefono',
    ];
}
