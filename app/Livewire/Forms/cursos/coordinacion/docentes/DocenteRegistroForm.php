<?php

namespace App\Livewire\Forms\cursos\coordinacion\docentes;

use Livewire\Attributes\Validate;
use Livewire\Form;

class DocenteRegistroForm extends Form
{
    #[Validate('required')]
    public $nombre = '';

    #[Validate('required')]
    public $apellidoPaterno = '';

    #[Validate('required')]
    public $apellidoMaterno = '';

    #[Validate('required')]
    public $fechaNacimiento = '';

    #[Validate('required')]
    public $sexo = '';

    #[Validate('required')]
    public $domicilio = '';

    #[Validate('required')]
    public $colonia = '';

    #[Validate('required')]
    public $localidadMunicipio = '';

    #[Validate('required')]
    public $perfilAcademico = '';

    #[Validate('required')]
    public $foto = '';

    #[Validate('required')]
    public $telefono = '';

    #[Validate('required')]
    public $email = '';

    #[Validate('required')]
    public $documentosEntregados = null;

    #[Validate('required')]
    public $observacion = ''; //bandera para saber si hay observaciones

    #[Validate('required')]
    public $observaciones = '';



    public function store()
    {
        $this->validate();
        dd("save form");
    }
}
