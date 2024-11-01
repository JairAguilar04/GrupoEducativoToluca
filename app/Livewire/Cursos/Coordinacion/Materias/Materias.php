<?php

namespace App\Livewire\Cursos\Coordinacion\Materias;

use App\Models\Materia;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-cursos')]

class Materias extends Component
{

    public $color = 'green';

    public function render()
    {

        $materias = Materia::get();

        return view(
            'livewire.cursos.coordinacion.materias.materias',
            ['materias' => $materias]
        );
    }
}
