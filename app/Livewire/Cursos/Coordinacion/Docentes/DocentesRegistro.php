<?php

namespace App\Livewire\Cursos\Coordinacion\Docentes;

use App\Livewire\Forms\cursos\coordinacion\docentes\DocenteRegistroForm;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-cursos')]

class DocentesRegistro extends Component
{

    public DocenteRegistroForm $form;

    public $id = 0;

    public function render()
    {
        return view('livewire.cursos.coordinacion.docentes.docentes-registro');
    }

    public function save()
    {
        $this->form->store();
    }
}
