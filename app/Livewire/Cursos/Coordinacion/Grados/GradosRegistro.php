<?php

namespace App\Livewire\Cursos\Coordinacion\Grados;

use App\Models\GradoAcademico;
use App\Models\Nivel;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

class GradosRegistro extends ModalComponent
{
    public $id;

    #[Validate('gt:0')]
    public $nivelAcademico;

    #[Validate('required|max:100')]
    public $nombre;

    public $formAction = 'save'; //funcionalida save o update
    public $niveles;

    protected $messages = [
        'nivelAcademico.gt' => 'El nivel académico no puede estar vacío.',
        'nombre.required' => 'El nombre del grado académico no puede estar vacío.',
        'nombre.max' => 'El nombre del grado académico es demasiado largo.',
    ];

    public function mount($id = 0)
    {
        $this->id = $id;
        if ($this->id != 0) {

            $grado = GradoAcademico::find($id);
            $this->nivelAcademico = $grado->nivel_id;
            $this->nombre = $grado->nombre;
            //dump($grado, $this->id, $this->nivelAcademico, $this->nombre);
        }
    }

    public function render()
    {
        $this->niveles = Nivel::whereIn('id', [3, 4, 5])->get();

        return view('livewire.cursos.coordinacion.grados.grados-registro');
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            GradoAcademico::create([
                'nivel_id' => $this->nivelAcademico,
                'nombre' => $this->nombre
            ]);

            DB::commit();
            return redirect('/cursos/grados-academicos')->with('success', 'El grado académico fue guardado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al guardar el grado académico.' . $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate();

        $grado = GradoAcademico::where('id', $this->id)->first();
        $grado->update([
            'nivel_id' => $this->nivelAcademico,
            'nombre' => $this->nombre,
        ]);

        try {

            DB::commit();
            return redirect('/cursos/grados-academicos')->with('success', 'El grado académico ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al actualizar el grado académico.' . $e->getMessage());
        }
    }
}
