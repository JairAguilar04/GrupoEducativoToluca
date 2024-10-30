<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CondicionPago extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'condiciones_pago';

    protected $fillable = [
        'usuario_id',
        'pago_id',
        'observaciones',
    ];
}
