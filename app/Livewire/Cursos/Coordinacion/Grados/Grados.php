<?php

namespace App\Livewire\Cursos\Coordinacion\Grados;

use App\Models\GradoAcademico;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-cursos')]

class Grados extends Component
{
    public function render()
    {
        $grados = GradoAcademico::whereIn('nivel_id', [3, 4, 5]);

        return view(
            'livewire.cursos.coordinacion.grados.grados',
            ['grados' => $grados->paginate(12)]
        );
    }
}
