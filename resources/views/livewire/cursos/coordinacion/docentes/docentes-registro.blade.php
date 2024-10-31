<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar docente') }}
        </h2>
    </x-slot>

    <div x-data="{ id: $wire.entangle('id') }">
        <form wire:submit="save">
            @csrf
            <div class="flex flex-col gap-y-8">
                <div class="flex flex-col gap-y-5">
                    {{-- nombre y apellidos --}}
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

                    {{-- fecha de nacimiento, sexo y domicilio --}}
                    <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                        <div class="sm:w-1/4 w-full">
                            <x-input-label for="fechaNacimiento" :value="__('Fecha de nacimiento')" />
                            <input type="date" name="fechaNacimiento" id="fechaNacimiento"
                                wire:model.live="form.fechaNacimiento" class="input-cursos">
                            <x-input-error :messages="$errors->first('form.fechaNacimiento')" class="mt-2" />
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

                        <div class="sm:w-1/2 w-full">
                            <x-input-label for="domicilio" :value="__('Domicilio')" />
                            <input type="text" name="domicilio" id="domicilio" wire:model.live="form.domicilio"
                                class="input-cursos" placeholder="Domicilio">
                            <x-input-error :messages="$errors->first('form.domicilio')" class="mt-2" />
                        </div>
                    </div>

                    {{-- colonia, localidad y municipio --}}
                    <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                        <div class="sm:w-3/5 w-full">
                            <x-input-label for="colonia" :value="__('Colonia')" />
                            <input type="text" name="colonia" id="colonia" wire:model.live="form.colonia"
                                class="input-cursos" placeholder="Colonia">
                            <x-input-error :messages="$errors->first('form.colonia')" class="mt-2" />
                        </div>

                        <div class="sm:w-2/5 w-full">
                            <x-input-label for="localidadMunicipio" :value="__('Localidad o municipio')" />
                            <input type="text" name="localidadMunicipio" id="localidadMunicipio"
                                wire:model.live="form.localidadMunicipio" class="input-cursos"
                                placeholder="Localidad o municipio">
                            <x-input-error :messages="$errors->first('form.localidadMunicipio')" class="mt-2" />
                        </div>
                    </div>

                    {{-- perfil academico y foto --}}
                    <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                        <div class="sm:w-3/5 w-full">
                            <x-input-label for="perfilAcademico" :value="__('Perfil académico')" />
                            <input type="text" name="perfilAcademico" id="perfilAcademico"
                                wire:model.live="form.perfilAcademico" class="input-cursos"
                                placeholder="Perfil académico">
                            <x-input-error :messages="$errors->first('form.perfilAcademico')" class="mt-2" />
                        </div>

                        <div class="sm:w-2/5 w-full">
                            <x-input-label for="foto" :value="__('Foto')" />
                            <div
                                class="flex items-center gap-x-2 border-2 border-moradoClaro-500 border-l-0 h-10 rounded-r-md">
                                <input type="file" name="foto" id="foto" wire:model.live="form.foto"
                                    class="input-file-cursos " accept=".png, .jpg" x-bind:disabled="id != 0">
                                <div class="w-full">
                                    {{-- @empty($form->foto)
                                        <label for="foto" class="text-sm cursor-pointer">
                                            Sin foto seleccionada.
                                        </label>
                                    @endempty
                                    @empty(!$form->foto)
                                        <div class="flex justify-between items-center">
                                            <p title="Clic para quitar archivo adjuntado." class="text-sm cursor-pointer">
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
                                    @endempty --}}
                                </div>
                            </div>
                            <x-input-error :messages="$errors->first('form.foto')" class="mt-2" />
                        </div>
                    </div>

                    {{-- perfil academico y foto --}}
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
                                class="input-cursos" placeholder="Correo electrónico" x-bind:disabled="id != 0" />
                            <x-input-error :messages="$errors->first('form.email')" class="mt-2" />
                        </div>
                    </div>

                    {{-- entrego todos sus documentos y observaciones --}}
                    <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                        <div class="sm:w-1/4 w-full">
                            <x-input-label for="si" :value="__('¿Entrego todos sus documentos?')" />
                            <div class="flex gap-x-5 sm:justify-normal justify-between sm:mx-0 mx-10">
                                <div>
                                    <input type="radio" name="documentos" id="si" value="1"
                                        wire:model.live="form.documentosEntregados" class="imput-radio-cursos">
                                    <label for="si">Si</label>
                                </div>
                                <div>
                                    <input type="radio" name="documentos" id="no" value="0"
                                        wire:model.live="form.documentosEntregados" class="imput-radio-cursos">
                                    <label for="no">No</label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->first('form.documentosEntregados')" class="mt-2" />
                        </div>

                        <div class="sm:w-2/4 w-full">
                            <x-input-label for="yes" :value="__('¿Deseas agregar alguna observación?')" />
                            <div class="flex gap-x-5 sm:justify-normal justify-between sm:mx-0 mx-10">
                                <div>
                                    <input type="radio" name="observacion" id="yes" value="1"
                                        wire:model.live="form.observacion" class="imput-radio-cursos">
                                    <label for="yes" class="font-medium text-sm mb-2">Si</label>
                                </div>
                                <div>
                                    <input type="radio" name="observacion" id="noo" value="0"
                                        wire:model.live="form.observacion" class="imput-radio-cursos">
                                    <label for="noo" class="font-medium text-sm mb-2">No</label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->first('form.observacion')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                        <div class="sm:w-3/4">
                            <x-input-label for="observaciones" :value="__('Observaciones')" />
                            <textarea name="observaciones" id="observaciones" wire:model.live="form.observaciones" cols="10"
                                rows="4" class="textarea-cursos" placeholder="Observaciones"></textarea>
                            <x-input-error :messages="$errors->first('form.observaciones')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{-- botones --}}
                <div class="flex sm:flex-row flex-col sm:justify-end justify-center mt-5">
                    <x-secondary-button class="button-secondary-cursos">
                        <a href="/cursos/alumnos">Regresar</a>
                    </x-secondary-button>

                    <x-primary-button class="button-primary-cursos">Guardar</x-primary-button>
                </div>
        </form>
    </div>
</div>
