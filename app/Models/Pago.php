<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    // public function pagosConcepto(): HasMany
    // {
    //     return $this->hasMany(ConceptoPago::class, 'id', 'concepto_id');
    // }

    public function pagosConcepto()
    {
        return $this->hasOne(ConceptoPago::class, 'id', 'concepto_id');
    }

    public function periodos()
    {
        return $this->hasOne(CantidadPeriodoPago::class, 'id', 'periodo_id');
    }
}
