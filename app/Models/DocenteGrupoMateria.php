<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteGrupoMateria extends Model
{
    use HasFactory;

    protected $table = 'docente_grupo_materia';

    protected $fillable = [
        'grupo_id',
        'materia_id',
        'docente_id'
    ];
}
