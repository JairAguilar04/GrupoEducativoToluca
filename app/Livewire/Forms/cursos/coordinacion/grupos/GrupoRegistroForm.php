<?php

namespace App\Livewire\Forms\cursos\coordinacion\grupos;

use App\Models\AlumnoGrupo;
use App\Models\DocenteGrupoMateria;
use App\Models\Grupo;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GrupoRegistroForm extends Form
{
    #[Validate('gt:0')]
    public int $idNivel = 0;

    #[Validate('gt:0')]
    public $idGrado = 0;

    #[Validate('required|array|min:1')]
    public $lisDocentes;

    #[Validate('required')]
    public $turno;

    #[Validate('required|integer|gt:0|lte:100')]
    public $capacidad;

    #[Validate('required')]
    public $color;

    #[Validate('required|array|min:1')]
    public $listAlumnos = [];

    #[Validate('required|after_or_equal:today')]
    public $fechaInicio;

    #[Validate('required|after:fechaInicio')]
    public $fechaFinal;

    protected $messages = [
        'idNivel.gt' => 'El nivel académico no puede estar vacío.',
        'idGrado.gt' => 'El grado académico no puede estar vacío.',

        'lisDocentes.required' => 'Debes asignar docentes a cada materia.',
        'lisDocentes.array' => 'Debes asignar docentes a cada materia en un formato correcto.',
        'lisDocentes.min' => 'Debes asignar al menos a un docentes por cada materia.',

        'turno.required' => 'El turno no puede estar vacío.',

        'capacidad.required' => 'La capacidad del grupo no puede estar vacía.',
        'capacidad.integer' => 'La capacidad del grupo debe de ser un número entero.',
        'capacidad.gt' => 'La capacidad del grupo debe de ser mayor a 0.',
        'capacidad.lte' => 'La capacidad del grupo debe de ser menor o igual a 100.',

        'color.required' => 'El color del grupo no puede estar vacío.',

        'listAlumnos.required' => 'Debes asignar alumnos al grupo.',
        'listAlumnos.array' => 'Debes asignar alumnos en un formato correcto.',
        'listAlumnos.min' => 'Debes asignar al menos a un alumno.',

        'fechaInicio.required' => 'La fecha de inicio no puede estar vacía.',
        'fechaInicio.after_or_equal' => 'La fecha de inicio debe de ser mayor o igual a la fecha actual.',

        'fechaFinal.required' => 'La fecha final no puede estar vacía.',
        'fechaFinal.after' => 'La fecha final debe de ser mayor a la fecha de inicio.',
    ];


    public function store()
    {
        $this->validate();

        DB::beginTransaction();
        try {

            //tabla grupo
            $grupo = new Grupo();
            $grupo->grado_id = $this->idGrado;
            $grupo->nombre = $this->nombreGrupo();
            $grupo->turno = $this->turno;
            $grupo->capacidad = $this->capacidad;
            $grupo->color = $this->color;
            $grupo->finalizado = 0;
            $grupo->fecha_inicio = $this->fechaInicio;
            $grupo->fecha_fin = $this->fechaFinal;
            $grupo->save();

            foreach ($this->lisDocentes as $docente => $i) {
                DocenteGrupoMateria::create([
                    'grupo_id' => $grupo->id,
                    'materia_id' => $i['id_materia'],
                    'docente_id' => $i['id_docente']
                ]);
            }

            foreach ($this->listAlumnos as $alumno => $i) {
                AlumnoGrupo::create([
                    'alumno_id' => $i['alumno_id'],
                    'grupo_id' => $grupo->id
                ]);
            }

            DB::commit();
            return redirect('/cursos/grupos')->with('success', 'Grupo guardado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al guardar el grupo.' . $e->getMessage());
        }
    }

    public function nombreGrupo()
    {
        $id = Grupo::max('id');
        $nombre = '';
        $abvNivel = '';
        $ceros = '';

        if ($this->idNivel == 3) {
            $abvNivel = 'CP';
        } elseif ($this->idNivel == 4) {
            $abvNivel = 'CL';
        } elseif ($this->idNivel == 5) {
            $abvNivel = 'LI';
        }

        $abvTurno = Str::charAt($this->turno, 0);
        $id++;

        if ($id < 10) {
            $ceros = '000';
        } elseif ($id < 100) {
            $ceros = '00';
        } elseif ($id < 1000) {
            $ceros = '0';
        }

        $nombre = 'G' . $abvNivel . $abvTurno . $ceros . $id;
        return $nombre;
    }
}
