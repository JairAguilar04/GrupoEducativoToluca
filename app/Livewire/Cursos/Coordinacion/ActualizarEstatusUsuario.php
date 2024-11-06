<?php

namespace App\Livewire\Cursos\Coordinacion;

use App\Models\Estatus;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

class ActualizarEstatusUsuario extends ModalComponent
{

    public $formAction = 'update';
    public $id;
    public $nombre;
    public $estatus;

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
        return view('livewire.cursos.coordinacion.actualizar-estatus-usuario');
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $usuario = User::where('id', $this->id)->first();
            $usuario->estatus_id = $this->estado;
            $usuario->save();
            //dump($usuario);

            DB::commit();
            return redirect('/cursos/alumnos')->with('success', 'El estatus del alumno ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al actualizar el estatus del alumno.' . $e->getMessage());
        }
    }
}
