<?php

namespace App\Livewire\Cursos\Coordinacion\Docentes;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-cursos')]

class Docentes extends Component
{

    public $columna = 'apellido_paterno'; //ordena por columna
    public $direccion = 'ASC'; // orden ASC o DESC
    public $search = '';

    public function render()
    {

        $docentes = User::where('estatus_id', 1)->whereIn('rol_id', [7, 8]);

        return view(
            'livewire.cursos.coordinacion.docentes.docentes',
            ['docentes' => $docentes->orderBy($this->columna, $this->direccion)->paginate(10, pageName: 'docentes')]
        );
    }

    //actualiza el paginador para que no se pierdan los resultados
    public function updatedSearch()
    {
        $this->resetPage(pageName: 'docentes');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function ordenarColumna($columna)
    {
        $this->columna = $columna;
        // si la direccion es ASC la pasamos a DESC, si es DESC la pasamos a ASC
        $this->direccion = $this->direccion == 'ASC' ? 'DESC' : 'ASC';
    }

    public function limpiarBuscador()
    {
        $this->search = '';
    }
}
