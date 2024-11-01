<?php

namespace App\Livewire\Cursos\Coordinacion\Materias;

use App\Models\GradoAcademico;
use LivewireUI\Modal\ModalComponent;

class MateriasRegistro extends ModalComponent
{

    public $grados;

    public function mount()
    {
        $this->grados = GradoAcademico::whereIn('nivel_id', [3, 4, 5])->get();
    }

    public function render()
    {
        return view('livewire.cursos.coordinacion.materias.materias-registro');
    }
}
