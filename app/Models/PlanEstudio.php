<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanEstudio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plan_estudios';

    protected $fillable = [
        'usuario_id',
        'nivel_id',
        'grado_id',
        'modalidad_id',
        'horario_id',
    ];

    public function modalidades(): BelongsTo
    {
        return $this->belongsTo(ModalidadEstudio::class, 'modalidad_id');
    }
}
