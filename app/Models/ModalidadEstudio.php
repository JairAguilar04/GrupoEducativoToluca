<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModalidadEstudio extends Model
{
    use HasFactory;

    protected $table = 'modalidades_estudios';

    protected $fillable = [
        'nivel_id',
        'nombre',
        'duracion',
    ];

    public function horarios(): BelongsToMany
    {
        return $this->belongsToMany(ModalidadEstudio::class, 'horario_modalidad', 'modalidad_id', 'horario_id');
    }
}
