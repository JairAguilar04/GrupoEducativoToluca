<?php

namespace App\Livewire\Cursos\Coordinacion\Grupos;

use App\Models\Grupo;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.admin-cursos')]
class Grupos extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        $grupos = Grupo::where('finalizado', 0);

        return view(
            'livewire.cursos.coordinacion.grupos.grupos',
            ['grupos' => $grupos->orderBy('nombre', 'ASC')->paginate(10)]
        );
    }
}
