<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorAlumno extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tutor_alumno';

    protected $fillable = [
        'usuario_id',
        'parentesco',
        'nombre_completo',
        'domicilio',
        'escolaridad',
        'ocupacion',
        'telefono',
    ];
}
