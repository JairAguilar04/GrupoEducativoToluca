<?php

namespace App\Livewire\Cursos\Coordinacion\Grados;

use App\Models\Nivel;
use LivewireUI\Modal\ModalComponent;

class GradosRegistro extends ModalComponent
{

    public $niveles;

    public function render()
    {

        $this->niveles = Nivel::whereIn('id', [3, 4, 5])->get();

        return view('livewire.cursos.coordinacion.grados.grados-registro');
    }
}
