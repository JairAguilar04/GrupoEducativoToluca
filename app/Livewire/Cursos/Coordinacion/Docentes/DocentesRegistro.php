<?php

namespace App\Livewire\Cursos\Coordinacion\Docentes;

use App\Livewire\Forms\cursos\coordinacion\docentes\DocenteRegistroForm;
use App\Models\DatoPersonal;
use App\Models\DocumentoEntregado;
use App\Models\Rol;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.admin-cursos')]

class DocentesRegistro extends Component
{
    use WithFileUploads;
    public DocenteRegistroForm $form;

    public $roles;

    public function mount($id = 0)
    {
        $this->roles = Rol::where('tipo_id', 4)->get();

        if ($id != 0) {
            $docente = User::find($id);
            $this->form->id = $docente->id;
            $this->form->rol = $docente->rol_id;
            $this->form->nombre = $docente->nombres;
            $this->form->apellidoPaterno = $docente->apellido_paterno;
            $this->form->apellidoMaterno = $docente->apellido_materno;
            $this->form->matricula = $docente->matricula;
            $this->form->email = $docente->email;
            $this->form->foto = $docente->url_foto;

            $datos = DatoPersonal::where('usuario_id', $id)->first();
            $this->form->fechaNacimiento = $datos->fecha_nacimiento;
            $this->form->sexo = $datos->sexo;
            $this->form->domicilio = $datos->domicilio;
            $this->form->colonia = $datos->colonia;
            $this->form->localidadMunicipio = $datos->localidad_municipio;
            $this->form->perfilAcademico = $datos->perfil_academico;
            $this->form->telefono = $datos->telefono;

            $documento = DocumentoEntregado::where('usuario_id', $id)->first();
            $this->form->documentosEntregados = $documento->entrego_todo;
            $this->form->observaciones = $documento->observaciones;
        }
    }

    public function render()
    {
        return view('livewire.cursos.coordinacion.docentes.docentes-registro');
    }

    public function save()
    {
        $this->form->store();
    }

    public function update($id)
    {
        $this->form->updated($id);
    }

    public function limpiarCampo($campo)
    {
        $this->form->$campo = null;
    }
}
