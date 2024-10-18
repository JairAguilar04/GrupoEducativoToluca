<?php

namespace App\Livewire\Cursos\Coordinacion;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.admin-cursos')]

class Alumnos extends Component
{

    use WithPagination;

    public $columna = 'apellido_paterno'; //ordena por columna
    public $direccion = 'ASC'; // orden ASC o DESC

    public function render()
    {

        $usuarios = User::whereIn('estatus_id', [1]);

        return view(
            'livewire.cursos.coordinacion.alumnos',
            ['usuarios' => $usuarios->orderBy($this->columna, $this->direccion)->paginate(5, pageName: 'usuarios')]
        );
    }

    public function ordenarColumna($columna)
    {
        $this->columna = $columna;
        // si la direccion es ASC la pasamos a DESC, si es DESC la pasamos a ASC
        $this->direccion = $this->direccion == 'ASC' ? 'DESC' : 'ASC';
    }
}
