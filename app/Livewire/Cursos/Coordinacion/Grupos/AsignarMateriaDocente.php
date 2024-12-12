<?php

namespace App\Livewire\Cursos\Coordinacion\Grupos;

use App\Models\GradoMateria;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;

class AsignarMateriaDocente extends ModalComponent
{
    public $formAction = 'save';

    public $_id = 0;

    //materia
    #[Validate('gt:0')]
    public $idMateria;
    public $nombreMateria;

    //docente
    #[Validate('required')]
    public $idDocente;

    public $idNivel;
    public $idGrado;

    //Modelos
    public $docentes;
    public $materias;

    //listas
    public $listMateria;
    public $listDocente;

    public $listeners = [
        'addDocente',
    ];

    protected $messages = [
        'idMateria.gt' => 'El nombre de la materia no puede estar vacío.',
        'idDocente.required' => 'El nombre del docente no puede estar vacío.',
    ];

    public function mount()
    {
        $this->materias = GradoMateria::where('grado_id', $this->idGrado)->get();

        if ($this->idNivel != 0) {
            if ($this->idNivel == 3) {
                $this->docentes = User::where('estatus_id', 1)->where('rol_id', 7)->get();
            } elseif ($this->idNivel == 4 || $this->idNivel == 5) {
                $this->docentes = User::where('estatus_id', 1)->where('rol_id', 8)->get();
            }
        }
    }

    public function render()
    {
        return view('livewire.cursos.coordinacion.grupos.asignar-materia-docente');
    }

    public function addMateria($idMateria, $nombreMateria)
    {
        $this->idMateria = $idMateria;
        $this->nombreMateria = $nombreMateria;
    }

    public function addDocente($idDocente, $nombreDocente)
    {

        $this->listDocente = [
            '_id' => 0,
            'id_materia' => $this->idMateria,
            'nombre_materia' =>  $this->nombreMateria,
            'id_docente' =>  $idDocente,
            'nombre_docente' =>  $nombreDocente
        ];
    }

    public function save()
    {


        $this->validate();
        $this->closeModalWithEvents([
            GruposRegistro::class => [
                'addDocente',
                [
                    $this->listDocente
                ]
            ]
        ]);
    }
}
