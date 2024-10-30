<?php

namespace App\Livewire\Cursos\Coordinacion;

use App\Livewire\Forms\Cursos\Coordinacion\AlumnosCursosForm;
use App\Models\CondicionPago;
use App\Models\DatoPersonal;
use App\Models\HorarioModalidad;
use App\Models\ModalidadEstudio;
use App\Models\Nivel;
use App\Models\Pago;
use App\Models\PlanEstudio;
use App\Models\TutorAlumno;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.admin-cursos')]

class AlumnosRegistro extends Component
{

    use WithFileUploads;
    public AlumnosCursosForm $form;

    public $parentescos = ['Madre', 'Padre'];
    public $modalidades;
    public $niveles;
    public $horarios;
    public $pagos;
    public $id;
    public $planEstudio;

    public function mount($id = 0)
    {

        $this->form->modalidadEstudio = collect(); // la hacemos coleccion

        $this->niveles = Nivel::whereIn('id', [3, 4])->get();
        $this->id = $id;

        if ($this->id != 0) {
            $usuario = User::find($id);
            $this->form->nombre = $usuario->nombres;
            $this->form->apellidoPaterno = $usuario->apellido_paterno;
            $this->form->apellidoMaterno = $usuario->apellido_materno;
            $this->form->matricula = $usuario->matricula;
            $this->form->email = $usuario->email;
            $this->form->foto = $usuario->url_foto;

            // datos personales
            $datosPersonales = DatoPersonal::where('usuario_id', $id)->first();
            if ($datosPersonales != null) {
                $this->form->fechaNacimiento = $datosPersonales->fecha_nacimiento;
                $this->form->curp = $datosPersonales->curp;
                $this->form->edad = $datosPersonales->edad;
                $this->form->sexo = $datosPersonales->sexo;
                $this->form->domicilio = $datosPersonales->domicilio;
                $this->form->localidadMunicipio = $datosPersonales->localidad_municipio;
                $this->form->telefono = $datosPersonales->telefono;
                $this->form->colonia = $datosPersonales->colonia;
            }


            //datos familiar
            $familiar = TutorAlumno::where('usuario_id', $id)->first();
            if ($familiar != null) {
                $this->form->parentesco = $familiar->parentesco;
                $this->form->nombreParentesco = $familiar->nombre_completo;
                $this->form->domicilioParentesco = $familiar->domicilio;
                $this->form->escolaridadParentesco = $familiar->escolaridad;
                $this->form->ocupacionParentesco = $familiar->ocupacion;
                $this->form->telefonoParentesco = $familiar->telefono;
            }

            //modalidad de estudio
            $modalidad = PlanEstudio::where('usuario_id', $id)->get();
            if ($modalidad != null) {
                $this->form->modalidadEstudio = collect();
                for ($i = 0; $i < count($modalidad); $i++) {
                    if ($i == 0) {
                        //dd($modalidad[$i]->horario_id);
                        $this->form->horario = $modalidad[$i]->horario_id;
                        $this->form->nivelAcademico = $modalidad[$i]->nivel_id;
                    }
                    $this->form->modalidadEstudio->push(
                        $modalidad[$i]->modalidad_id
                    );
                    $this->planEstudio = $modalidad->whereIn('modalidad_id', $this->form->modalidadEstudio);
                }

                //dd($this->form->modalidadEstudio);
                // foreach ($modalidad as $mod => $key) {
                //     $this->form->nivelAcademico = $key->nivel_id;
                //     $this->form->horario = $key->horario_id;
                //     $this->form->modalidadEstudio = collect();
                //     $this->form->modalidadEstudio = $mod->modalidad_id;
                //     $this->form->modalidadEstudio->push(
                //         $key->modalidad_id
                //     );
                // }
            }

            //condicion pago
            $pago = CondicionPago::where('usuario_id', $id)->first();
            if ($pago != null) {
                $this->form->colegiatura = $pago->pago_id;
                $this->form->observaciones = $pago->observaciones;

                $this->form->observaciones != null ? $this->form->observacion = 1 : $this->form->observacion = 0;
            }
        }
    }

    public function render()
    {
        $this->modalidades = ModalidadEstudio::where('nivel_id', $this->form->nivelAcademico)->get();
        $this->pagos = Pago::where('nivel_id', $this->form->nivelAcademico)->where('concepto_id', 3)->get();
        // $this->horarios = HorarioModalidad::where('modalidad_id', $this->form->modalidadEstudio)->get();

        $this->horarios = HorarioModalidad::where('modalidad_id', $this->form->modalidadEstudio->first())->get();

        // calcular la edad automaticamente y si es mayor de edad
        if ($this->form->fechaNacimiento != null) {
            $this->form->edad = Carbon::createFromDate($this->form->fechaNacimiento)->age;

            if ($this->form->edad < 18) {
                $this->form->menorEdad = 1; //si es menor de edad
            } else {
                $this->form->menorEdad = 0; //no es mayor de edad
            }
        }

        //calculamos el rol del nuevo alumno
        $this->form->nivelAcademico == 3 ?  $this->form->rol = 3 :  $this->form->rol = 4;

        return view('livewire.cursos.coordinacion.alumnos-registro');
    }

    public function save()
    {
        $this->form->store();
    }

    public function generarMatricula()
    {
        $this->form->matricula();
    }

    public function update()
    {
        $this->form->updated($this->id);
    }

    public function limpiarCampo($campo)
    {
        if ($campo == 'observaciones' || $campo == 'foto') {
            $this->form->$campo = null;
        } elseif ($campo == 'modalidadColegiatura') { //se cambio el nivel academico
            $this->form->modalidadEstudio = [];
            $this->form->modalidadEstudio = collect(); // la hacemos coleccion
            $this->form->colegiatura = 0;
        } elseif ($campo = 'horario') { // se cambio la modalidad de estudio
            $this->form->horario = 0;
        }
    }

    public function addModalidades(int $motivo)
    {
        $existe = 0;
        $index = null;

        foreach ($this->form->modalidadEstudio as $mot => $key) {
            if ($key == $motivo) {
                $existe = 1;
                $index = $mot;
            }
        }

        if ($existe == 1) {
            $this->form->modalidadEstudio->forget($index);
        } else {
            $this->form->modalidadEstudio->push(
                $motivo
            );
        }

        $this->form->modalidadEstudio->all();

        $this->validateOnly($this->form->modalidadEstudio);
    }
}
