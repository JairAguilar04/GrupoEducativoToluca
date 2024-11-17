<?php

namespace App\Livewire\Cursos\Docentes\Actividades;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.alumno-cursos')]

class AsignarActividad extends Component
{
    public function render()
    {
        return view('livewire.cursos.docentes.actividades.asignar-actividad');
    }
}
