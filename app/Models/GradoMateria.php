<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradoMateria extends Model
{
    use HasFactory;

    protected $table = 'grado_materia';
    protected $fillable = [
        'grado_id',
        'materia_id',
    ];

    public function materias(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
