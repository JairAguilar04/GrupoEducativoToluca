<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoEntregado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documentacion_entregada';

    protected $fillable = [
        'usuario_id',
        'documento_id',
        'entrego',
        'fecha_recepcion',
        'usuario_recibe',
        'fecha_devolucion',
        'usuario_devuelve',
        'entrego_todo',
        'observaciones',
    ];
}
