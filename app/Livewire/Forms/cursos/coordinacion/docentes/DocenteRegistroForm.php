<?php

namespace App\Livewire\Forms\cursos\coordinacion\docentes;

use App\Models\DatoPersonal;
use App\Models\DocumentoEntregado;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DocenteRegistroForm extends Form
{
    public $id = 0;

    #[Validate('required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s.]*$/u|max:80')]
    public $nombre = '';

    #[Validate('required|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s.]*$/u')]
    public $apellidoPaterno = '';

    #[Validate('nullable|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s.]*$/u')]
    public $apellidoMaterno = '';

    #[Validate('required|before:today')]
    public $fechaNacimiento = '';

    #[Validate('required')]
    public $sexo = '';

    #[Validate('required|max:255')]
    public $domicilio = '';

    #[Validate('required|max:150')]
    public $colonia = '';

    #[Validate('required|max:150')]
    public $localidadMunicipio = 'Toluca de lerdo';

    #[Validate('required|max:150')]
    public $perfilAcademico = '';

    // #[Validate('required|mimes:jpg,png|max:2000')]
    public $foto = null;

    #[Validate('required|regex:/^[0-9]*$/u|size:10')]
    public $telefono = '';

    // #[Validate("required|email|unique:users,email|regex:'^[^@]+@[^@]+\.[a-zA-Z]{2,}$'|max:100")]
    public $email = '';

    #[Validate('required')]
    public $documentosEntregados = null;

    #[Validate('required_if:documentosEntregados,0|max:255')]
    public $observaciones = null;

    #[Validate('gt:0')]
    public $rol;

    public $matricula;


    protected $messages = [
        'nombre.required' => 'El nombre no puede estar vacío.',
        'nombre.regex' => 'El nombre no puede tener caracteres especiales.',
        'nombre.max' => 'El nombre es demasiado largo.',

        'apellidoPaterno.required' => 'El apellido paterno no puede estar vacío.',
        'apellidoPaterno.regex' => 'El apellido paterno no puede tener caracteres especiales.',
        'apellidoPaterno.max' => 'El apellido paterno es demasiado largo.',

        'apellidoMaterno.regex' => 'El apellido materno no puede tener caracteres especiales.',
        'apellidoMaterno.max' => 'El apellido materno es demasiado largo.',

        'fechaNacimiento.required' => 'La fecha de nacimiento no puede estar vacía.',
        'fechaNacimiento.before' => 'La fecha de nacimiento es invalida.',

        'sexo.required' => 'El sexo no puede estar vacío.',

        'domicilio.required' => 'El domicilio no puede estar vacío.',
        'domicilio.max' => 'El domicilio es demasiado largo.',

        'colonia.required' => 'La colonia no puede estar vacía.',
        'colonia.max' => 'La colonia es demasiado larga.',

        'localidadMunicipio.required' => 'La localidad o municipio no pueden estar vacíos.',
        'localidadMunicipio.max' => 'La localidad o municipio es demasiado larga.',

        'perfilAcademico.required' => 'El perfil académico no puede estar vacío.',
        'perfilAcademico.max' => 'El perfil académico es demasiado largo.',

        'foto.required' => 'La foto del docente no puede estar vacía.',
        'foto.mimes' => 'La foto del docente no tiene el formato correcto (.jpg, .png).',
        'foto.max' => 'La foto del docente no debe pesar mas de 2 MB.',

        'telefono.required' => 'El teléfono no puede estar vacío.',
        'telefono.regex' => 'El teléfono no tiene un formato valido.',
        'telefono.size' => 'El teléfono no es valido.',

        'email.required' => 'El correo electrónico no puede estar vacío.',
        'email.regex' => 'El correo electrónico no tiene un formato valido.',
        'email.email' => 'El correo electrónico no tiene un formato valido.',
        'email.unique' => 'El correo electrónico ya existe.',
        'email.max' => 'El correo electrónico es muy largo.',

        'documentosEntregados.required' => 'Debes de seleccionar una opción.',

        'observaciones.required_if' => 'La observacion no puede estar vacía.',
        'observaciones.max' => 'La observación es demasiado larga.',

        'rol.gt' => 'El nivel del docente no puede estar vacío.',
    ];


    public function store()
    {

        $this->validate();
        $this->validate([
            'email' => "required|email|unique:users,email|regex:'^[^@]+@[^@]+\.[a-zA-Z]{2,}$'|max:100",
            'foto' => 'required|mimes:jpg,png|max:2000',
        ]);

        DB::beginTransaction();

        try {
            $docente = new User();
            $docente->estatus_id = 1;
            $docente->rol_id = $this->rol;
            $docente->alta_usuario = Auth::user()->id;
            $docente->nombres = Str::ucfirst($this->nombre);
            $docente->apellido_paterno = Str::ucfirst($this->apellidoPaterno);
            $docente->apellido_materno = Str::ucfirst($this->apellidoMaterno);
            $docente->matricula = $this->matricula();
            $docente->email = $this->email;
            $docente->password = 'password';
            $docente->url_foto = $this->urlFoto($docente->matricula);
            $docente->save();

            $edad = Carbon::createFromDate($this->fechaNacimiento)->age;

            DatoPersonal::create([
                'usuario_id' => $docente->id,
                'perfil_academico' => $this->perfilAcademico,
                'fecha_nacimiento' => $this->fechaNacimiento,
                'edad' => $edad,
                'sexo' => $this->sexo,
                'domicilio' => $this->domicilio,
                'colonia' => $this->colonia,
                'localidad_municipio' => $this->localidadMunicipio,
                'telefono' => $this->telefono,
            ]);

            DocumentoEntregado::create([
                'usuario_id' => $docente->id,
                'entrego_todo' => $this->documentosEntregados,
                'observaciones' => $this->observaciones
            ]);

            DB::commit();
            return redirect('/cursos/docentes')->with('success', 'Docente guardado correctamente, con matricula ' . $docente->matricula . '. Recuerdale al docente que debe cambiar su contraseña.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al guardar al docente.' . $e->getMessage());
        }
    }


    public function updated($id)
    {
        $docente = User::find($id);

        $this->validate();
        $this->validate([
            'email' => ['required', 'email', 'max:100', Rule::unique(User::class)->ignore($docente->id)]
        ]);

        DB::beginTransaction();

        try {
            $docente->update([
                'rol_id' => $this->rol,
                'alta_usuario' => Auth::user()->id,
                'nombres' => Str::ucfirst($this->nombre),
                'apellido_paterno' => Str::ucfirst($this->apellidoPaterno),
                'apellido_materno' => Str::ucfirst($this->apellidoMaterno),
                'email' => $this->email,
            ]);

            $edad = Carbon::createFromDate($this->fechaNacimiento)->age;

            $datos = DatoPersonal::where('usuario_id', $id)->first();
            $datos->update([
                'perfil_academico' => $this->perfilAcademico,
                'fecha_nacimiento' => $this->fechaNacimiento,
                'edad' => $edad,
                'sexo' => $this->sexo,
                'domicilio' => $this->domicilio,
                'colonia' => $this->colonia,
                'localidad_municipio' => $this->localidadMunicipio,
                'telefono' => $this->telefono,
            ]);

            $documento = DocumentoEntregado::where('usuario_id', $id)->first();
            $documento->update([
                'entrego_todo' => $this->documentosEntregados,
                'observaciones' => $this->observaciones,
            ]);

            DB::commit();
            return redirect('/cursos/docentes')->with('success', 'El docente con matricula ' . $this->matricula . ', ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al actualizar al docente.' . $e->getMessage());
        }
    }

    public function matricula()
    {
        $date = today();
        $year = $date->format('y');

        $contador = User::withTrashed()->count();
        ++$contador;

        $ceros = '';
        $matricula = '';

        if ($contador < 10) {
            $ceros = '000';
        } elseif ($contador < 100) {
            $ceros = '00';
        } elseif ($contador < 1000) {
            $ceros = '0';
        }

        $matricula = 'GET' . $year . 'D' . $ceros . $contador;

        return $matricula;
    }

    public function urlFoto($matricula)
    {
        $rutaFoto = '';
        $nombreFoto = '';

        if ($this->rol == 7) {
            $rutaFoto = '/cursos/preparatoria/docentes/fotos/';
        } elseif ($this->rol == 8) {
            $rutaFoto = '/cursos/licenciatura/docentes/fotos/';
        }


        $nombreFoto = $matricula . '.' . $this->foto->getClientOriginalExtension();

        //guardamos la imagen en el sistema de archivos
        $this->foto->storeAS($rutaFoto, $nombreFoto, 'public');

        //ruta a guardar en DB
        $rutaFoto = 'storage' . $rutaFoto . $nombreFoto;

        return $rutaFoto;
    }
}
