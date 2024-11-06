<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GradoAcademico extends Model
{
    use HasFactory;

    protected $table = 'grados_academicos';

    protected $fillable = [
        'nivel_id',
        'nombre',
    ];

    public function nivel(): HasOne
    {
        return $this->hasOne(Nivel::class, 'id', 'nivel_id');
    }
}
