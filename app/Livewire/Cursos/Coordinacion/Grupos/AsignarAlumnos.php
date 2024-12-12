<?php

namespace App\Livewire\Cursos\Coordinacion\Grupos;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;

class AsignarAlumnos extends ModalComponent
{
    public $formAction = 'save';
    public $idNivel;
    public $alumnos;
    public $collection;
    public $capacidad;
    public $mensaje = '';

    #[Validate('required|array|min:1')]
    public $listAlumnos;

    protected $messages = [
        'listAlumnos.required' => 'Debes de seleccionar al menos un alumno.',
        'listAlumnos.array' => '',
        'listAlumnos.min' => 'Debes de seleccionar al menos un alumno.',
    ];

    public $listeners = [
        'addAlumno',
    ];

    public function mount()
    {
        if ($this->idNivel != 0) {
            if ($this->idNivel == 4 || $this->idNivel == 5) {
                $this->alumnos = User::where('estatus_id', 1)->where('rol_id', 4)->orderBy('nombres', 'ASC')->get();
                $this->collection = collect($this->alumnos);
            } elseif ($this->idNivel == 3) {
                $this->alumnos = User::where('estatus_id', 1)->where('rol_id', 3)->orderBy('nombres', 'ASC')->get();
                $this->collection = collect($this->alumnos);
            }
        } else {
            $this->collection = [];
        }
    }

    public function render()
    {
        return view('livewire.cursos.coordinacion.grupos.asignar-alumnos');
    }

    public function addAlumnos($idAlumno, $nombre)
    {
        $this->listAlumnos = collect($this->listAlumnos);
        $newItemId = $this->listAlumnos->max('_id') + 1;
        $alumnoExiste = $this->listAlumnos->where('alumno_id', $idAlumno);


        if (count($this->listAlumnos) < $this->capacidad) {
            if (count($alumnoExiste) == 0) {
                $this->listAlumnos->push([
                    '_id' => $newItemId,
                    'alumno_id' => $idAlumno,
                    'nombre' => $nombre
                ]);

                $this->mensaje = '';
            } else {
                $this->mensaje = 'El alumno ya fue agregado previamente.';
            }
        } else {
            $this->mensaje = 'El grupo ya esta completo.';
        }
    }

    public function save()
    {
        $this->validate();
        $this->closeModalWithEvents([
            GruposRegistro::class => [
                'addAlumno',
                [$this->listAlumnos]
            ]
        ]);
    }
}
