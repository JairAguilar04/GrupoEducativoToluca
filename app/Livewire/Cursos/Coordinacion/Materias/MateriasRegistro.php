<?php

namespace App\Livewire\Cursos\Coordinacion\Materias;

use App\Livewire\Forms\cursos\coordinacion\materias\MateriasRegistroForm;
use App\Models\GradoAcademico;
use App\Models\Materia;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithPagination;

class MateriasRegistro extends ModalComponent
{
    use WithPagination;
    public MateriasRegistroForm $form;

    public $formAction = 'save';
    public $colores = ['Amarillo', 'Anaranjado', 'Azul', 'Morado', 'Rojo', 'Rosa', 'Verde'];

    public $grados;
    public $searchMateria = [];
    public $materiaExiste = 0;
    public $asignacion = false; //se abrio desde materias
    public int $idGrado = 0;
    public $nombreGrado;

    public function mount(int $id = 0)
    {
        $this->grados = GradoAcademico::whereIn('nivel_id', [3, 4, 5])->orderBy('nombre', 'ASC')->get();

        //es para asignar materia a grupo
        if ($this->formAction == 'asignar') {
            $this->asignacion = true; //se abrio desde grados academicos
            $this->form->grado = $this->idGrado;
            $this->nombreGrado = $this->grados->find($this->idGrado);
            $this->nombreGrado = $this->nombreGrado->nombre;
            $this->materiaExiste = 1;
        }

        if ($id != 0) {
            $materia = Materia::find($id);
            $this->form->id = $materia->id;
            $this->form->nombre = $materia->nombre;
            $this->form->estatus = $materia->estatus;
            $this->form->color = $materia->color;
        }
    }

    public function render()
    {
        if ($this->materiaExiste == 1 && $this->formAction == 'save') {
            $this->formAction = 'asignar';
        } elseif (($this->materiaExiste == 0 || $this->materiaExiste == '') && ($this->formAction == 'asignar')) {
            $this->formAction = 'save';
        }

        return view(
            'livewire.cursos.coordinacion.materias.materias-registro'
        );
    }

    public function save()
    {
        $this->form->store();
    }

    public function update()
    {
        $this->form->updated($this->form->id);
    }

    public function asignar()
    {
        $this->form->asignado();
    }

    public function buscarMateria($materia)
    {
        if (!empty($this->form->nombre) && $this->materiaExiste) {
            $this->searchMateria = Materia::where('estatus', 1)->where('nombre', 'like', '%' . $materia . '%')->limit(5)->get();
            $this->form->idMateria = null;
        } else {
            $this->searchMateria = [];
        }
    }
}
