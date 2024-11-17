<?php

namespace App\Livewire\Cursos\Coordinacion\Docentes;

use App\Models\DatoPersonal;
use App\Models\DocumentoEntregado;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.admin-cursos')]

class Docentes extends Component
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

        $docentes = User::where('estatus_id', 1)->whereIn('rol_id', [7, 8]);

        $docentes->where(function ($query) {
            $query->where('nombres', 'like', '%' . $this->search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $this->search . '%')
                ->orWhere('apellido_materno', 'like', '%' . $this->search . '%')
                ->orWhere('matricula', 'like', '%' . $this->search . '%');
        });

        return view(
            'livewire.cursos.coordinacion.docentes.docentes',
            ['docentes' => $docentes->orderBy($this->columna, $this->direccion)->paginate(10, pageName: 'docentes')]
        );
    }

    //actualiza el paginador para que no se pierdan los resultados
    public function updatedSearch()
    {
        $this->resetPage(pageName: 'docentes');
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

            //eliminamos sus datos del usuario
            $datos = DatoPersonal::where('usuario_id', $id)->first();
            $datos->delete();

            //eliminamos sus documentos del usuario
            $documentos = DocumentoEntregado::where('usuario_id', $id)->first();
            $documentos->delete();

            DB::commit();
            return redirect('/cursos/docentes')->with('success', 'El docente fue eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al eliminar al docente.' . $e->getMessage());
        }
    }

    public function limpiarBuscador()
    {
        $this->search = '';
    }
}
