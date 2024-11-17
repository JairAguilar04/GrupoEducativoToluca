<?php

namespace App\Livewire\Cursos\Coordinacion;

use App\Models\Estatus;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActualizarEstatusUsuario extends ModalComponent
{

    public $formAction = 'update';
    public $id;
    public $nombre;
    public $estatus;
    public $rol;

    #[Validate('gt:0')]
    public $estado;

    protected $messages = [
        'estado.gt' => 'El estatus no puede estar vacío.'
    ];

    public function mount()
    {
        $this->estatus = Estatus::get();
    }

    public function render()
    {

        $this->rol = User::find($this->id);
        $this->rol = $this->rol->rol_id;

        return view('livewire.cursos.coordinacion.actualizar-estatus-usuario');
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $usuario = User::find($this->id);
            $usuario->update([
                'estatus_id' => $this->estado,
                'alta_usuario' => Auth::user()->id,
            ]);

            DB::commit();

            if ($this->rol == 3 || $this->rol == 4) {
                return redirect('/cursos/alumnos')->with('success', 'El estatus del alumno ' . $this->nombre . ' ha sido actualizado correctamente.');
            } elseif ($this->rol == 7 || $this->rol == 8) {
                return redirect('/cursos/docentes')->with('success', 'El estatus del docente ' . $this->nombre . ' ha sido actualizado correctamente.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al actualizar el estatus de ' . $this->nombre . ': ' . $e->getMessage());
        }
    }
}
