<?php

namespace App\Livewire\Forms\cursos\coordinacion\materias;

use App\Models\GradoMateria;
use App\Models\Materia;
use Livewire\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MateriasRegistroForm extends Form
{
    public $id = 0;

    public $grado = 0;
    public $nombre = '';
    public $color = '';
    public $estatus;

    public $idMateria;

    protected $messages = [
        'nombre.required' => 'El nombre de la materia no puede estar vacío.',
        'nombre.unique' => 'El nombre de la materia ya existe.',
        'nombre.max' => 'El nombre de la materia es demasiado largo.',
        'grado.gt' => 'El grado académico no puede estar vacío.',
        'color.required' => 'El color no puede estar vacío.',
        'idMateria.gt' => 'Selecciona una materia.',
    ];

    public function store()
    {
        $this->validate([
            'nombre' => 'required|unique:materias,nombre|max:150',
            'grado' => 'gt:0',
            'color' => 'required'
        ]);

        DB::beginTransaction();
        try {

            $materia = Materia::create([
                'nombre' => $this->nombre,
                'color' => $this->color,
                'estatus' => 1,
            ]);

            GradoMateria::create([
                'grado_id' => $this->grado,
                'materia_id' => $materia->id,
            ]);

            DB::commit();
            return redirect('/cursos/materias')->with('success', 'Materia guardada correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al guardar la materia.' . $e->getMessage());
        }
    }

    public function updated($id)
    {
        $materia = Materia::find($id);

        $this->validate([
            'nombre' => [Rule::unique(Materia::class)->ignore($materia->id), 'required', 'max:150'],
            'color' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $materia->update([
                'nombre' => $this->nombre,
                'color' => $this->color,
                'estatus' => $this->estatus,
            ]);

            DB::commit();
            return redirect('/cursos/materias')->with('success', 'La materia fue actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al actualizar la materia.' . $e->getMessage());
        }
    }

    public function asignado()
    {
        $this->validate([
            'grado' => 'gt:0',
            'idMateria' => 'gt:0'
        ]);

        DB::beginTransaction();
        try {

            GradoMateria::create([
                'grado_id' => $this->grado,
                'materia_id' => $this->idMateria,
            ]);

            DB::commit();
            return redirect('/cursos/materias')->with('success', 'La materia fue asignada correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al asignar la materia.' . $e->getMessage());
        }
    }
}
