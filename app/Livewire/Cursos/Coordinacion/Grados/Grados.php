<?php

namespace App\Livewire\Cursos\Coordinacion\Grados;

use App\Models\GradoAcademico;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.admin-cursos')]

class Grados extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        $grados = GradoAcademico::whereIn('nivel_id', [3, 4, 5]);

        if (!empty($this->search)) {
            $grados->where('nombre', 'LIKE', '%' . $this->search . '%');
        }

        return view(
            'livewire.cursos.coordinacion.grados.grados',
            ['grados' => $grados->orderBy('nombre', 'ASC')->paginate(12)]
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
