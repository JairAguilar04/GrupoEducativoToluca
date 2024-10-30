<?php

namespace App\Livewire\Cursos\Coordinacion;

use App\Models\CondicionPago;
use App\Models\DatoPersonal;
use App\Models\PlanEstudio;
use App\Models\TutorAlumno;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.admin-cursos')]

class Alumnos extends Component
{

    use WithPagination;

    public $columna = 'apellido_paterno'; //ordena por columna
    public $direccion = 'ASC'; // orden ASC o DESC
    public $search = '';

    public $listeners = [
        'delete'
    ];

    public function render()
    {

        $usuarios = User::where('estatus_id', 1)->whereIn('rol_id', [3, 4]);
        //$usuarios = User::withTrashed();

        $usuarios->where(function ($query) {
            $query->where('nombres', 'like', '%' . $this->search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $this->search . '%')
                ->orWhere('apellido_materno', 'like', '%' . $this->search . '%')
                ->orWhere('matricula', 'like', '%' . $this->search . '%');
        });

        return view(
            'livewire.cursos.coordinacion.alumnos',
            ['usuarios' => $usuarios->orderBy($this->columna, $this->direccion)->paginate(10, pageName: 'usuarios')]
        );
    }

    //actualiza el paginador para que no se pierdan los resultados
    public function updatedSearch()
    {
        $this->resetPage(pageName: 'usuarios');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function ordenarColumna($columna)
    {
        $this->columna = $columna;
        // si la direccion es ASC la pasamos a DESC, si es DESC la pasamos a ASC
        $this->direccion = $this->direccion == 'ASC' ? 'DESC' : 'ASC';
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            //eliminamos el usuario
            $usuario = User::find($id);
            $usuario->delete();

            //eliminamos datos personales
            $datos = DatoPersonal::where('usuario_id', $id)->first();
            $datos->delete();

            //si hay tutor lo eliminamos
            $tutor = TutorAlumno::where('usuario_id', $id)->first();
            if ($tutor != null) {
                $tutor->delete();
            }

            //eliminamos el plan de estudios
            $planes = PlanEstudio::where('usuario_id', $id)->get();
            foreach ($planes as $plan) {
                $plan->delete();
            }

            //eliminamos la colegiatura
            $colegiatura = CondicionPago::where('usuario_id', $id)->first();
            $colegiatura->delete();

            DB::commit();
            return redirect('/cursos/alumnos')->with('success', 'El alumno fue eluminado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al eliminar al alumno.' . $e->getMessage());
        }
    }

    public function limpiarBuscador()
    {
        $this->search = '';
    }
}
