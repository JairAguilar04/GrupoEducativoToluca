<?php

namespace App\Livewire\Cursos\Coordinacion\Grupos;

use App\Livewire\Forms\cursos\coordinacion\grupos\GrupoRegistroForm;
use App\Models\GradoAcademico;
use App\Models\GradoMateria;
use App\Models\Nivel;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-cursos')]

class GruposRegistro extends Component
{
    public GrupoRegistroForm $form;

    public $grados;
    public $materias;
    //public $alumnos = [];
    public $niveles;
    public $turnos = ['Matutino', 'Vespertino'];
    public $colores = ['Amarillo', 'Anaranjado', 'Azul', 'Morado', 'Rojo', 'Rosa', 'Verde'];
    public $mensaje = '';

    public $listeners = [
        'addDocente',
        'addAlumno'
    ];

    public function mount()
    {
        $this->niveles = Nivel::whereIn('id', [3, 4, 5])->get();
        $this->form->listAlumnos = collect($this->form->listAlumnos);
    }

    public function render()
    {
        $this->grados = GradoAcademico::where('nivel_id', $this->form->idNivel)->orderBy('nombre', 'ASC')->get();
        $this->materias = GradoMateria::where('grado_id', $this->form->idGrado)->get();

        return view('livewire.cursos.coordinacion.grupos.grupos-registro');
    }

    public function save()
    {
        $this->form->store();
    }

    public function addDocente($arreglo)
    {
        $id = $arreglo['_id'];
        $idMateria = $arreglo['id_materia'];

        $this->form->lisDocentes = collect($this->form->lisDocentes);
        $newItemId = $this->form->lisDocentes->max('_id') + 1;
        $materiaExiste = $this->form->lisDocentes->where('id_materia', $idMateria);

        if (count($materiaExiste) == 0) {
            if ($id == 0) {
                $this->form->lisDocentes->push([
                    '_id' => $newItemId,
                    'id_materia' => $arreglo['id_materia'],
                    'nombre_materia' => $arreglo['nombre_materia'],
                    'id_docente' => $arreglo['id_docente'],
                    'nombre_docente' => $arreglo['nombre_docente'],
                ]);

                $this->mensaje = '';
            }
        } else {
            $this->mensaje = 'La materia ya ha sido asignada a un docente.';
        }
    }


    public function addAlumno($alumnos)
    {
        $this->form->listAlumnos = $alumnos;
    }

    public function limpiarCampo($campo)
    {

        if ($campo == 'nivel') {
            $this->form->idGrado = null;
        }

        $this->form->lisDocentes = [];
        $this->form->listAlumnos = [];
    }
}
