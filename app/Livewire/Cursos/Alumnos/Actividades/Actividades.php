<?php

namespace App\Livewire\Cursos\Alumnos\Actividades;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.alumno-cursos')]

class Actividades extends Component
{
    public function render()
    {
        return view('livewire.cursos.alumnos.actividades.actividades');
    }
}
