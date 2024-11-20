<?php

namespace App\Livewire\Cursos\Coordinacion\Materias;

use App\Models\Materia;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.admin-cursos')]

class Materias extends Component
{

    use WithPagination;
    public $search = '';
    public $estatus = 1;

    public function render()
    {
        $materias = Materia::where('estatus', $this->estatus);

        if (!empty($this->search)) {
            $materias->where('nombre', 'like', '%' . $this->search . '%');
            // ->where('estatus', $this->estatus);
        }

        return view(
            'livewire.cursos.coordinacion.materias.materias',
            ['materias' => $materias->orderBy('nombre', 'ASC')->paginate(12, pageName: 'materias')]
        );
    }

    //actualiza el paginador para que no se pierdan los resultados
    public function updatedSearch()
    {
        $this->resetPage(pageName: 'materias');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function limpiarBuscador()
    {
        $this->search = '';
    }
}
