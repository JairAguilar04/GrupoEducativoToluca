<?php

namespace App\Livewire\Cursos\Coordinacion\Grados;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-cursos')]

class Grados extends Component
{
    public function render()
    {
        return view('livewire.cursos.coordinacion.grados.grados');
    }
}
