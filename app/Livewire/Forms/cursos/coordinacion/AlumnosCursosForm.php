<?php

namespace App\Livewire\Forms\Cursos\Coordinacion;

use App\Livewire\Cursos\Coordinacion\AlumnosRegistro;
use App\Models\CondicionPago;
use App\Models\DatoPersonal;
use App\Models\PlanEstudio;
use App\Models\TutorAlumno;
use App\Models\User;
use Livewire\Form;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AlumnosCursosForm extends Form
{
    #[Validate('required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s.]*$/u|max:80')]
    public $nombre = '';

    #[Validate('required|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s.]*$/u')]
    public $apellidoPaterno = '';

    #[Validate('nullable|max:50|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s.]*$/u')]
    public $apellidoMaterno = '';

    #[Validate('required|max:255')]
    public $domicilio = '';

    #[Validate('required|before:today')]
    public $fechaNacimiento = '';


    #[Validate('nullable|max:18|regex:/^[A-Za-z0-9]*$/u|min:18')]
    public $curp = '';

    #[Validate('required|integer|numeric|max:100')]
    public $edad;

    public $menorEdad = 0; //es una bandera para saber si es menor de edad

    #[Validate('required')]
    public $sexo;

    #[Validate('required|max:150')]
    public $colonia;

    #[Validate('required|max:150')]
    public $localidadMunicipio = 'Toluca de lerdo';

    //#[Validate('required|mimes:jpg,png|max:2000')]
    public $foto = null;

    #[Validate('required|regex:/^[0-9()+]*$/u|size:10')]
    public $telefono = '';

    // #[Validate("required|email|unique:users,email|regex:'^[^@]+@[^@]+\.[a-zA-Z]{2,}$'|max:100")]
    public $email = '';

    public $matricula;

    // parentesco
    #[Validate('required_if:menorEdad,1')]
    public $parentesco;

    #[Validate('required_if:menorEdad,1|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s.]*$/u|max:200')]
    public $nombreParentesco = '';

    #[Validate('required_if:menorEdad,1|max:255')]
    public $domicilioParentesco = '';

    #[Validate('required_if:menorEdad,1|max:100')]
    public $escolaridadParentesco = '';

    #[Validate('required_if:menorEdad,1|max:150')]
    public $ocupacionParentesco = '';

    #[Validate('required_if:menorEdad,1|regex:/^[0-9()+]*$/u|size:10')]
    public $telefonoParentesco = '';

    // modalidad de estudio
    #[Validate('gt:0')]
    public $nivelAcademico;

    #[Validate('required_if:nivelAcademico,4')]
    public $carrera;

    #[Validate('required')]
    public $modalidadEstudio;

    #[Validate('gt:0')]
    public $horario;

    //pagos
    #[Validate('gt:0')]
    public $colegiatura;

    #[Validate('required')]
    public $observacion; //bandera para saber si habra observaciones

    #[Validate('required_if:observacion,1|max:255')]
    public $observaciones = null;

    public $rol;

    public AlumnosRegistro $alumno;

    protected $messages = [
        'nombre.required' => 'El nombre no puede estar vacío.',
        'nombre.regex' => 'El nombre no puede tener caracteres especiales.',
        'nombre.max' => 'El nombre es demasiado largo.',

        'apellidoPaterno.required' => 'El apellido paterno no puede estar vacío.',
        'apellidoPaterno.regex' => 'El apellido paterno no puede tener caracteres especiales.',
        'apellidoPaterno.max' => 'El apellido paterno es demasiado largo.',

        'apellidoMaterno.regex' => 'El apellido materno no puede tener caracteres especiales.',
        'apellidoMaterno.max' => 'El apellido materno es demasiado largo.',

        'domicilio.required' => 'El domicilio del alumno no puede estar vacío.',
        'domicilio.max' => 'El domicilio del alumno es demasiado largo.',

        'fechaNacimiento.required' => 'La fecha de nacimiento no puede estar vacía.',
        'fechaNacimiento.date' => 'La fecha de nacimiento no tiene un formato válido.',
        'fechaNacimiento.before' => 'La fecha de nacimiento es invalida.',

        'curp.required' => 'La CURP no puede estar vacía.',
        'curp.regex' => 'La CURP no tiene un formato válido.',
        'curp.max' => 'La CURP debe de tener 18 caracteres.',
        'curp.min' => 'La CURP debe de tener 18 caracteres.',

        'edad.required' => 'La edad no puede estar vacía.',
        'edad.integer' => 'La edad debe de ser un número entero.',
        'edad.numeric' => 'La edad debe de ser un número entero.',
        'edad.max' => 'La edad es demasiado larga.',

        'sexo.required' => 'El sexo no puede estar vacío.',

        'colonia.required' => 'La colonia no puede estar vacía.',
        'colonia.max' => 'La colonia es demasiado larga.',

        'localidadMunicipio.required' => 'La localidad o municipio no pueden estar vacíos.',
        'localidadMunicipio.max' => 'La localidad o municipio es demasiado larga.',

        'foto.required' => 'La foto del alumno no puede estar vacía.',
        'foto.mimes' => 'La foto del alumno no tiene el formato correcto (.jpg, .png).',
        'foto.max' => 'La foto del alumno no debe pesar mas de 2 MB.',

        'telefono.required' => 'El teléfono del alumno no puede estar vacío.',
        'telefono.regex' => 'El teléfono del alumno no tiene un formato valido.',
        'telefono.size' => 'El teléfono del alumno debe de contener 10 caracteres.',


        'email.required' => 'El correo electrónico no puede estar vacío.',
        'email.regex' => 'El correo electrónico no tiene un formato valido.',
        'email.email' => 'El correo electrónico no tiene un formato valido.',
        'email.unique' => 'El correo electrónico ya existe.',
        'email.max' => 'El correo electrónico es muy largo.',

        // 'matricula.required' => 'La matricula del alumno no puede estar vacía.',
        // 'matricula.unique' => 'La matricula del alumno ya existe.',
        // 'matricula.max' => 'La matricula del alumno es demasiado larga.',

        'parentesco.required_if' => 'El parentesco del alumno no puede estar vacío.',

        'nombreParentesco.required_if' => 'El nombre del parentesco no puede estar vacío.',
        'nombreParentesco.regex' => 'El nombre del parentesco no puede tener caracteres especiales.',
        'nombreParentesco.max' => 'El nombre del parentesco es demasiado largo.',

        'domicilioParentesco.required_if' => 'El domicilio del parentesco no puede estar vacío.',
        'domicilioParentesco.max' => 'El domicilio del parentesco es demasiado largo.',

        'escolaridadParentesco.required_if' => 'La escolaridad del parentesco no puede estar vacía.',
        'escolaridadParentesco.max' => 'La escolaridad del parentesco es demasiado larga.',

        'ocupacionParentesco.required_if' => 'La ocupación del parentesco no puede estar vacía.',
        'ocupacionParentesco.max' => 'La ocupación del parentesco es demasiado larga.',

        'telefonoParentesco.required_if' => 'El teléfono del parentesco no puede estar vacío.',
        'telefonoParentesco.regex' => 'El teléfono del parentesco no tiene un formato valido.',
        'telefonoParentesco.size' => 'El teléfono del parentesco debe de contener 10 caracteres.',

        'nivelAcademico.gt' => 'El nivel académico no puede estar vacío.',

        'carrera.required_if' => 'La carrera a estudiar no puede estar vacía.',

        'modalidadEstudio.required' => 'La modalidad de estudio no puede estar vacía.',

        'horario.gt' => 'El horario no puede estar vacío.',

        'colegiatura.gt' => 'La colegiatura no puede estar vacía.',

        'observacion.required' => 'Debes de seleccionar una opción.',

        'observaciones.required_if' => 'La observación no pueden estar vacía.',
        'observaciones.max' => 'La observación es demasiado larga.',
    ];


    public function store()
    {
        $this->validate();
        $this->validate([
            'email' => "required|email|unique:users,email|regex:'^[^@]+@[^@]+\.[a-zA-Z]{2,}$'|max:100",
            'foto' => 'required|mimes:jpg,png|max:2000'
        ]);

        DB::beginTransaction();

        try {
            // tabla usuarios
            $usuario = new User();
            $usuario->estatus_id = 1;
            $usuario->rol_id = $this->rol;
            $usuario->alta_usuario = Auth::user()->id;
            $usuario->nombres = Str::ucfirst($this->nombre);
            $usuario->apellido_paterno = Str::ucfirst($this->apellidoPaterno);
            $usuario->apellido_materno = Str::ucfirst($this->apellidoMaterno);
            $usuario->matricula = $this->matricula();
            $usuario->email = $this->email;
            $usuario->password = 'password';
            $usuario->url_foto = $this->urlFoto($usuario->matricula);
            $usuario->save();

            $datosPersonales = new DatoPersonal();
            $datosPersonales->usuario_id = $usuario->id;
            $datosPersonales->fecha_nacimiento = $this->fechaNacimiento;
            $datosPersonales->curp = Str::upper($this->curp);
            $datosPersonales->edad = $this->edad;
            $datosPersonales->sexo = $this->sexo;
            $datosPersonales->domicilio = $this->domicilio;
            $datosPersonales->colonia = $this->colonia;
            $datosPersonales->localidad_municipio = $this->localidadMunicipio;
            $datosPersonales->telefono = $this->telefono;
            $datosPersonales->save();

            if ($this->menorEdad || $this->parentesco != null || $this->domicilioParentesco != null) {
                $datosFamiliar = new TutorAlumno();
                $datosFamiliar->usuario_id = $usuario->id;
                $datosFamiliar->parentesco = $this->parentesco;
                $datosFamiliar->nombre_completo = $this->nombreParentesco;
                $datosFamiliar->domicilio = $this->domicilioParentesco;
                $datosFamiliar->escolaridad = $this->escolaridadParentesco;
                $datosFamiliar->ocupacion = $this->ocupacionParentesco;
                $datosFamiliar->telefono = $this->telefono;
                $datosFamiliar->save();
            }

            foreach ($this->modalidadEstudio as $modalidad => $key) {
                PlanEstudio::create([
                    'usuario_id' => $usuario->id,
                    'nivel_id' => $this->nivelAcademico,
                    'grado_id' => $this->carrera > 0 ? (int) $this->carrera : null,
                    'modalidad_id' => $key,
                    'horario_id' => $this->horario,
                ]);
            }

            $pago = new CondicionPago();
            $pago->usuario_id = $usuario->id;
            $pago->pago_id = $this->colegiatura;
            $pago->observaciones = $this->observaciones;
            $pago->save();


            DB::commit();
            return redirect('/cursos/alumnos')->with('success', 'Alumno guardado correctamente, con matricula ' . $usuario->matricula . '. Recuerdale al alumno que debe cambiar su contraseña.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al guardar al alumno.' . $e->getMessage());
        }
    }

    public function updated($id)
    {

        $this->validate();

        DB::beginTransaction();

        try {

            //actualizamos el usuario
            $usuario = User::find($id);
            $usuario->update([
                'alta_usuario' => Auth::user()->id,
                'nombres' => Str::ucfirst($this->nombre),
                'apellido_paterno' => Str::ucfirst($this->apellidoPaterno),
                'apellido_materno' => Str::ucfirst($this->apellidoMaterno),

            ]);

            //actualizamos los datos personales
            $datosPersonalesUpdate = DatoPersonal::where('usuario_id', $id)->first();
            $datosPersonalesUpdate->update([
                'fecha_nacimiento' => $this->fechaNacimiento,
                'curp' => $this->curp,
                'edad' => $this->edad,
                'sexo' => $this->sexo,
                'domicilio' => $this->domicilio,
                'colonia' => $this->colonia,
                'localidad_municipio' => $this->localidadMunicipio,
                'telefono' => $this->telefono,
            ]);


            //actualizamos el tutor del alumno
            $this->parentesco = empty($this->parentesco) ? null : $this->parentesco;

            $tutorUpdate = TutorAlumno::where('usuario_id', $id)->first();
            if ($tutorUpdate != null) { //si hay un registro hacemos el update
                $tutorUpdate->update([
                    'parentesco' => $this->parentesco,
                    'nombre_completo' => $this->nombreParentesco,
                    'domicilio' => $this->domicilioParentesco,
                    'escolaridad' => $this->escolaridadParentesco,
                    'ocupacion' => $this->ocupacionParentesco,
                    'telefono' => $this->telefonoParentesco,
                ]);
            } elseif ($this->parentesco != null) {
                TutorAlumno::create([
                    'usuario_id' => $id,
                    'parentesco' => $this->parentesco,
                    'nombre_completo' => $this->nombreParentesco,
                    'domicilio' => $this->domicilioParentesco,
                    'escolaridad' => $this->escolaridadParentesco,
                    'ocupacion' => $this->ocupacionParentesco,
                    'telefono' => $this->telefonoParentesco,
                ]);
            }

            //actualizamos el horario y la carrera
            $horarios = PlanEstudio::where('usuario_id', $id)->get();
            foreach ($horarios as $horario) {
                $horario->update([
                    'grado_id' => $this->carrera > 0 ? (int) $this->carrera : null,
                    'horario_id' => $this->horario,
                ]);
            }

            //actualizamos la colegiatura
            $pago = CondicionPago::where('usuario_id', $id)->first();
            $pago->update([
                'pago_id' => $this->colegiatura,
                'observaciones' => $this->observaciones,
            ]);


            DB::commit();
            return redirect('/cursos/alumnos')->with('success', 'El alumno con matricula ' . $this->matricula . ', ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errorDb', 'Error al actualizar al alumno.' . $e->getMessage());
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

        $matricula = 'GET' . $year . 'A' . $ceros . $contador;

        return $matricula;
    }

    public function urlFoto($matricula)
    {
        $rutaFoto = '';
        $nombreFoto = '';


        // if (Storage::disk('public')->exists($matricula)) {
        //     Storage::disk('public')->delete($matricula);
        //     $matricula = 'GET24A0044 ';
        // }

        if ($this->rol == 3) {
            $rutaFoto = '/cursos/preparatoria/alumnos/fotos/';
        } elseif ($this->rol == 4) {
            $rutaFoto = '/cursos/licenciatura/alumnos/fotos/';
        }


        $nombreFoto = $matricula . '.' . $this->foto->getClientOriginalExtension();

        //guardamos la imagen en el sistema de archivos
        $this->foto->storeAS($rutaFoto, $nombreFoto, 'public');

        //ruta a guardar en DB
        $rutaFoto = 'storage' . $rutaFoto . $nombreFoto;

        return $rutaFoto;
    }
}
