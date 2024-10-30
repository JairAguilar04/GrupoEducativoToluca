<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioModalidad extends Model
{
    use HasFactory;

    protected $table = 'horario_modalidad';

    public function horarios(): BelongsTo
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }
}
