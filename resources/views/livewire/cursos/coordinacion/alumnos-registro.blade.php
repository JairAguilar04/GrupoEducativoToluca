<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $id != 0 ? 'Editar alumno: ' . $form->matricula : __('Registrar alumno') }}
        </h2>
    </x-slot>

    <div x-data="{ id: $wire.entangle('id'), nivel: $wire.entangle('form.nivelAcademico'), openn: false }">
        <form wire:submit="save">
            @csrf
            <div class="flex flex-col gap-y-8">
                {{-- Seccion de datos personales --}}
                <div x-data="{ open: true }">
                    <button type="button" @click="open = ! open" class="button-titulos-form-cursos">
                        Datos personales
                    </button>

                    <div x-show="open" class="flex flex-col gap-y-5 mt-5">
                        {{-- nombre completo --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-1/3 w-full">
                                <x-input-label for="nombre" :value="__('Nombre(s)')" />
                                <input type="text" name="nombre" id="nombre" wire:model.live="form.nombre"
                                    class="input-cursos" placeholder="Nombre(s)" autofocus="autofocus">
                                <x-input-error :messages="$errors->first('form.nombre')" class="mt-2" />
                            </div>

                            <div class="sm:w-1/3 w-full">
                                <x-input-label for="apellidoPaterno" :value="__('Apellido paterno')" />
                                <input type="text" name="apellidoPaterno" id="apellidoPaterno"
                                    wire:model.live="form.apellidoPaterno" class="input-cursos"
                                    placeholder="Apellido paterno">
                                <x-input-error :messages="$errors->first('form.apellidoPaterno')" class="mt-2" />
                            </div>

                            <div class="sm:w-1/3 w-full">
                                <label for="apellidoMaterno" class="label">Apellido materno</label>
                                <input type="text" name="apellidoMaterno" id="apellidoMaterno"
                                    wire:model.live="form.apellidoMaterno" class="input-cursos"
                                    placeholder="Apellido materno">
                                <x-input-error :messages="$errors->first('form.apellidoMaterno')" class="mt-2" />
                            </div>
                        </div>

                        {{-- fecha de nacimiento, edad, curp  y sexo --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-1/4 w-full">
                                <x-input-label for="fechaNacimiento" :value="__('Fecha de nacimiento')" />
                                <input type="date" name="fechaNacimiento" id="fechaNacimiento"
                                    wire:model.live="form.fechaNacimiento" class="input-cursos">
                                <x-input-error :messages="$errors->first('form.fechaNacimiento')" class="mt-2" />
                            </div>

                            <div class="sm:w-1/4 w-full">
                                <label for="curp" class="label">CURP</label>
                                <input type="text" name="curp" id="curp" wire:model.live="form.curp"
                                    class="input-cursos uppercase" placeholder="CURP" maxlength="18">
                                <x-input-error :messages="$errors->first('form.curp')" class="mt-2" />
                            </div>

                            <div class="sm:w-1/4 w-full">
                                <x-input-label for="edad" :value="__('Edad')" />
                                <input type="text" name="edad" id="edad" wire:model.live="form.edad"
                                    class="input-cursos" disabled placeholder="Edad" min="1" max="100">
                                <x-input-error :messages="$errors->first('form.edad')" class="mt-2" />
                            </div>

                            <div class="sm:w-1/4 w-full">
                                <x-input-label for="mujer" :value="__('Sexo')" />
                                <div class="flex justify-between mx-5">
                                    <div>
                                        <input type="radio" name="sexo" id="mujer" value="F"
                                            wire:model.live="form.sexo" class="imput-radio-cursos">
                                        <label for="mujer">Mujer</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="sexo" id="hombre" value="M"
                                            wire:model.live="form.sexo" class="imput-radio-cursos">
                                        <label for="hombre">Hombre</label>
                                    </div>
                                </div>

                                <x-input-error :messages="$errors->first('form.sexo')" class="mt-2" />
                            </div>
                        </div>

                        {{-- domicilio y colonia --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-3/5 w-full">
                                <x-input-label for="domicilio" :value="__('Domicilio(calle y número)')" />
                                <input type="text" name="domicilio" id="domicilio" wire:model.live="form.domicilio"
                                    class="input-cursos" placeholder="Domicilio(calle y número)">
                                <x-input-error :messages="$errors->first('form.domicilio')" class="mt-2" />
                            </div>

                            <div class="sm:w-2/5 w-full">
                                <x-input-label for="colonia" :value="__('Colonia')" />
                                <input type="text" name="colonia" id="colonia" wire:model.live="form.colonia"
                                    class="input-cursos" placeholder="Colonia">
                                <x-input-error :messages="$errors->first('form.colonia')" class="mt-2" />
                            </div>
                        </div>

                        {{-- municipio y foto --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-3/5 w-full">
                                <x-input-label for="localidadMunicipio" :value="__('Localidad o municipio')" />
                                <input type="text" name="localidadMunicipio" id="localidadMunicipio"
                                    wire:model.live="form.localidadMunicipio" class="input-cursos"
                                    placeholder="Localidad o municipio">
                                <x-input-error :messages="$errors->first('form.localidadMunicipio')" class="mt-2" />
                            </div>

                            <div class="sm:w-2/5 w-full">
                                <x-input-label for="foto" :value="__('Foto')" />
                                <div
                                    class="flex items-center gap-x-2 border-2 border-moradoClaro-500 border-l-0 h-10 rounded-r-md">
                                    <input type="file" name="foto" id="foto" wire:model.live="form.foto"
                                        class="input-file-cursos " accept=".png, .jpg" x-bind:disabled="id != 0">
                                    <div class="w-full">
                                        @empty($form->foto)
                                            <label for="foto" class="text-sm cursor-pointer">
                                                Sin foto seleccionada.
                                            </label>
                                        @endempty
                                        @empty(!$form->foto)
                                            <div class="flex justify-between items-center">
                                                <p title="Clic para quitar archivo adjuntado."
                                                    class="text-sm cursor-pointer">
                                                    {{-- {{ $id != 0 ? Str::after($form->foto, 'fotos/') : $form->foto->firstClientOriginalName() }} --}}
                                                    @if ($id == 0)
                                                        {{ $form->foto->getClientOriginalName() }}
                                                    @elseif(Str::contains($form->foto, '\Temp'))
                                                        {{ $form->foto->getClientOriginalName() }}
                                                    @elseif($id != 0)
                                                        {{ Str::after($form->foto, 'fotos/') }}
                                                    @endif
                                                </p>
                                                <button type="button" wire:click="limpiarCampo('foto')"
                                                    class="mr-2 hover:bg-moradoClaro-200 rounded-md button-normal"
                                                    x-bind:disabled="id != 0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"
                                                        class="w-5 h-5">
                                                        <path
                                                            d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endempty
                                    </div>
                                </div>
                                <div wire:loading wire:target="form.foto">
                                    <span class="text-sm text-gray-700">Cargando foto...</span>
                                </div>
                                <x-input-error :messages="$errors->first('form.foto')" class="mt-2" />
                            </div>
                        </div>

                        {{-- telefono y correo --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-2/5 w-full">
                                <x-input-label for="telefono" :value="__('Teléfono')" />
                                <input type="text" name="telefono" id="telefono" wire:model.live="form.telefono"
                                    class="input-cursos" placeholder="Teléfono" />
                                <x-input-error :messages="$errors->first('form.telefono')" class="mt-2" />
                            </div>

                            <div class="sm:w-3/5 w-full">
                                <x-input-label for="email" :value="__('Correo electrónico')" />
                                <input type="text" name="email" id="email" wire:model.live="form.email"
                                    class="input-cursos" placeholder="Correo electrónico"
                                    x-bind:disabled="id != 0" />
                                <x-input-error :messages="$errors->first('form.email')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Datos familiar --}}
                <div x-data="{ open: id != 0 ? true : false }">
                    <button type="button" @click="open = ! open" class="button-titulos-form-cursos">
                        Datos familiares
                    </button>
                    <div x-show="open" class="flex flex-col gap-y-5 mt-5">
                        {{-- parentesco y nombre --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-1/4 w-full">
                                <label for="parentesco" class="label">Parentesco</label>
                                <select name="parentesco" id="parentesco" wire:model.live="form.parentesco"
                                    class="input-cursos">
                                    <option value="">Selecciona una opción</option>
                                    @for ($i = 0; $i < count($parentescos); $i++)
                                        <option value="{{ $parentescos[$i] }}">
                                            {{ $parentescos[$i] }}
                                        </option>
                                    @endfor
                                </select>
                                <x-input-error :messages="$errors->first('form.parentesco')" class="mt-2" />
                            </div>

                            <div class="sm:w-3/4 w-full">
                                <label for="nombreParentesco" class="label">Nombre completo</label>
                                <input type="text" name="nombreParentesco" id="nombreParentesco"
                                    wire:model.live="form.nombreParentesco" class="input-cursos"
                                    placeholder="Nombre completo" />
                                <x-input-error :messages="$errors->first('form.nombreParentesco')" class="mt-2" />
                            </div>
                        </div>

                        {{-- domicilio y escolaridad --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-3/4 w-full">
                                <label for="domicilioParentesco" class="label">Domicilio parentesco</label>
                                <input type="text" name="domicilioParentesco" id="domicilioParentesco"
                                    wire:model.live="form.domicilioParentesco" class="input-cursos"
                                    placeholder="Domicilio parentesco" />
                                <x-input-error :messages="$errors->first('form.domicilioParentesco')" class="mt-2" />
                            </div>

                            <div class="sm:w-1/4 w-full">
                                <label for="escolaridadParentesco" class="label">Escolaridad</label>
                                <input type="text" name="escolaridadParentesco" id="escolaridadParentesco"
                                    wire:model.live="form.escolaridadParentesco" class="input-cursos"
                                    placeholder="Escolaridad" />
                                <x-input-error :messages="$errors->first('form.escolaridadParentesco')" class="mt-2" />
                            </div>
                        </div>

                        {{-- ocupacion y telefono --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-3/5 w-full">
                                <label for="ocupacionParentesco" class="label">Ocupación</label>
                                <input type="text" name="ocupacionParentesco" id="ocupacionParentesco"
                                    wire:model.live="form.ocupacionParentesco" class="input-cursos"
                                    placeholder="Ocupación" />
                                <x-input-error :messages="$errors->first('form.ocupacionParentesco')" class="mt-2" />
                            </div>

                            <div class="sm:w-2/5 w-full">
                                <label for="telefonoParentesco" class="label">Teléfono</label>
                                <input type="text" name="telefonoParentesco" id="telefonoParentesco"
                                    wire:model.live="form.telefonoParentesco" class="input-cursos"
                                    placeholder="Teléfono" />
                                <x-input-error :messages="$errors->first('form.telefonoParentesco')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Plan de estudios --}}
                <div x-data="{ open: id != 0 ? true : false }">
                    <button type="button" @click="open = ! open" class="button-titulos-form-cursos">
                        Plan de estudios
                    </button>
                    <div x-show="open" class="flex flex-col gap-y-5 mt-5">
                        {{-- nivel academico --}}
                        <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-1/3 w-full">
                                <x-input-label for="nivelAcademico" :value="__('Area de estudios')" />
                                <select name="nivelAcademico" id="nivelAcademico"
                                    wire:model.live="form.nivelAcademico"
                                    wire:change="limpiarCampo('modalidadColegiatura')" class="input-cursos"
                                    x-on:change="openn = true" x-bind:disabled="id != 0">
                                    <option value="0">Selecciona una opción</option>
                                    @foreach ($niveles as $nivel)
                                        <option value="{{ $nivel->id }}">
                                            {{ $nivel->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->first('form.nivelAcademico')" class="mt-2" />
                            </div>

                            <div x-show="nivel == 4" class="sm:w-2/3 w-full">
                                <x-input-label for="carrera" :value="__('Carrera a estudiar')" />
                                <select name="carrera" id="carrera" wire:model.live="form.carrera"
                                    class="input-cursos">
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($licenciaturas as $licenciatura)
                                        <option value="{{ $licenciatura->id }}">
                                            {{ $licenciatura->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->first('form.carrera')" class="mt-2" />
                            </div>
                        </div>
                        {{-- modalidad y horarios --}}
                        <div x-data="{ modalidad: $wire.entangle('form.modalidadEstudio') }" x-show="nivel != 0 && nivel != null"
                            class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div x-data="{ open: id != 0 ? true : false }" class="sm:w-1/3 w-full">
                                <p class="label">
                                    Motivo<span class="font-bold text-red-600">*</span>
                                </p>
                                <button type="button" @click="open = ! open"
                                    class="input-cursos border border-moradoClaro-500 text-start px-2 flex items-center justify-between">
                                    Selecciona una o varias opciones
                                    <svg class="w-3 h-3 ms-2.5 mr-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <div x-show="open" @click.outside="open = false"
                                    class="bg-moradoClaro-100 rounded-md rounded-t-none">
                                    <ul class="flex flex-col gap-y-1">
                                        <li>
                                            @if ($id == 0)
                                                @foreach ($modalidades as $modalidad)
                                                    <div
                                                        class="flex gap-x-2 items-center select-none hover:bg-gray-200 p-1 px-4">
                                                        <input type="checkbox" class="imput-radio-cursos"
                                                            name="group[]" id="{{ $modalidad->id }}"
                                                            value="{{ $modalidad->id }}" class="block"
                                                            wire:change="addModalidades({{ $modalidad->id }})" />
                                                        <label for="{{ $modalidad->id }}" class="w-full block">
                                                            {{ $modalidad->nombre }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @elseif ($id != 0)
                                                @foreach ($planEstudio as $plan)
                                                    <div
                                                        class="flex gap-x-2 items-center select-none hover:bg-gray-200 p-1 px-4">
                                                        <input type="radio"
                                                            class="imput-radio-cursos  disabled:cursor-not-allowed"
                                                            name="{{ $plan->id }}" id="{{ $plan->id }}"
                                                            checked="checked" disabled />
                                                        <p class="w-full">
                                                            {{ $plan->modalidades->nombre }}
                                                        </p>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <x-input-error :messages="$errors->first('form.modalidadEstudio')" class="mt-2" />
                            </div>

                            <div x-show="modalidad != 0 && modalidad != null" class="sm:w-2/3 w-full">
                                <x-input-label for="horario" :value="__('Horario')" />
                                <select name="horario" id="horario" wire:model.live="form.horario"
                                    class="input-cursos">
                                    <option value="0">Selecciona una opción</option>
                                    @foreach ($horarios as $horario)
                                        <option value="{{ $horario->horario_id }}">
                                            {{ $horario->horarios->dia . ' - ' . $horario->horarios->horario }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->first('form.horario')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- condiciones de pago --}}
                <div x-data="{ open: id != 0 ? true : false }">
                    <button type="button" x-on:change="openn = false" @click="open = ! open"
                        class="button-titulos-form-cursos">
                        Condiciones de pago
                    </button>
                    <div x-data="{ observacion: $wire.entangle('form.observacion'), observaciones: $wire.entangle('form.observaciones') }" x-show="open" class="flex flex-col gap-y-5 mt-5">
                        <div class="flex sm:flex-row flex-col sm:gap-x-8 gap-y-5">
                            <div class="sm:w-1/4 w-full">
                                <x-input-label for="colegiatura" :value="__('Colegiatura')" />
                                <select name="colegiatura" id="colegiatura" wire:model.live="form.colegiatura"
                                    class="input-cursos" x-bind:disabled="nivel < 1">
                                    <option value="0">
                                        Selecciona una opción
                                    </option>
                                    @foreach ($pagos as $pago)
                                        <option value="{{ $pago->id }}">
                                            {{ $pago->periodos->nombre . ' - $' . $pago->monto_unitario }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->first('form.colegiatura')" class="mt-2" />
                            </div>

                            <div class="sm:w-2/4 w-full">
                                <x-input-label for="si" :value="__('¿Deseas agregar alguna observación?')" />
                                <div class="flex gap-x-5 sm:justify-normal justify-between sm:mx-0 mx-10">
                                    <div>
                                        <input type="radio" name="observacion" id="si" value="1"
                                            wire:model.live="form.observacion" class="imput-radio-cursos">
                                        <label for="si" class="font-medium text-sm mb-2">Si</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="observacion" id="no" value="0"
                                            wire:model.live="form.observacion" class="imput-radio-cursos"
                                            wire:click="limpiarCampo('observaciones')">
                                        <label for="no" class="font-medium text-sm mb-2">No</label>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->first('form.observacion')" class="mt-2" />
                            </div>
                        </div>
                        <div x-show="(observacion != 0 && observacion != null) || (observaciones != null)"
                            class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                            <div class="sm:w-3/4">
                                <x-input-label for="observaciones" :value="__('Observaciones')" />
                                <textarea name="observaciones" id="observaciones" wire:model.live="form.observaciones" cols="10"
                                    rows="4" class="textarea-cursos" placeholder="Observaciones"></textarea>
                                <x-input-error :messages="$errors->first('form.observaciones')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- botones --}}
            <div class="flex sm:flex-row flex-col sm:justify-end justify-center mt-5">
                <x-secondary-button class="button-secondary-cursos">
                    <a href="/cursos/alumnos">Regresar</a>
                </x-secondary-button>
                @if ($id != 0)
                    {{-- entro a editar --}}
                    <x-secondary-button wire:click="update()" class="button-primary-cursos">
                        Guardar
                    </x-secondary-button>
                @elseif ($id == 0)
                    {{-- es un nuevo registro --}}
                    <x-primary-button class="button-primary-cursos">Guardar</x-primary-button>
                @endif
            </div>
        </form>

        {{-- errores en formulario --}}
        @if ($errors->any())
            <div class="bg-moradoClaro-100 mt-5">
                <h2 class="bg-moradoClaro-400 text-white text-xl pl-2">Faltan campos por completar:</h2>
                <p class="p-4">
                    Comprueba que todos los campos esten llenos o que cumplan con el formato solicitado, todos los
                    campos
                    con <span class="text-red-600 font-bold">*</span> son requeridos.
                </p>
            </div>
        @endif

        {{-- error en base de datos --}}
        @session('errorDb')
            <div class="bg-red-100 mt-5">
                <h2 class="bg-red-500 text-white text-xl pl-2">Error en DB:</h2>
                <p class="p-4">
                    {{ Session::get('errorDb') }}
                </p>
            </div>
        @endsession

    </div>
</div>
