<x-modal>
    <x-slot name="title">
        @if ($formAction == 'save')
            Agregar materia
        @elseif ($formAction == 'update')
            Editar materia
        @else
            Asignar materia: {{ $nombreGrado }}
        @endif
    </x-slot>

    <x-slot name="formAction">
        {{ $formAction }}
        <x-slot name="content">
            <div x-data="{ id: $wire.entangle('form.id'), materia: $wire.entangle('materiaExiste'), nombre: $wire.entangle('form.nombre'), formAction: $wire.entangle('formAction'), accion: $wire.entangle('asignacion') }" class="flex flex-col gap-y-5">
                <div x-show="id == 0 && accion == false" class="w-full">
                    <x-input-label for="nombre" :value="__('Grado académico')" />
                    <select name="grado" id="grado" wire:model.live="form.grado" class="input-cursos"
                        autofocus="autofocus">
                        <option value="0">Selecciona una opción</option>
                        @foreach ($grados as $grado)
                            <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->first('form.grado')" class="mt-2" />
                </div>

                <div class="w-full">
                    <x-input-label for="nombre" :value="__('Nombre de la materia')" />
                    <textarea name="nombre" id="nombre" cols="30" rows="2" wire:model.live="form.nombre"
                        wire:keyup="buscarMateria('{{ $form->nombre }}')" wire:change="buscarMateria('{{ $form->nombre }}')"
                        class="textarea-cursos" placeholder="Nombre"></textarea>
                    <x-input-error :messages="$errors->first('form.nombre')" class="mt-2" />
                </div>

                <div x-show="id == 0  && accion == false" class="flex justify-end items-center gap-x-2 -mb-8">
                    <input type="checkbox" name="existe" id="existe" value="1" wire:model.live="materiaExiste"
                        wire:click="buscarMateria('{{ $form->nombre }}')" class="imput-radio-cursos">
                    <label for="existe" class="label">¿La materia ya existe?</label>
                </div>

                <div x-show="materia != 1" class="w-full">
                    <x-input-label for="color" :value="__('Color de la materia')" />
                    <select name="color" id="color" wire:model.live="form.color" class="input-cursos">
                        <option value="">Selecciona una opción</option>
                        @foreach ($colores as $color => $key)
                            <option value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->first('form.color')" class="mt-2" />
                </div>

                <div x-show="id != 0" class="w-full">
                    <x-input-label for="estatus" :value="__('Estatus')" />
                    <select name="estatus" id="estatus" wire:model.live="form.estatus" class="input-cursos">
                        <option value="0">Desactivada</option>
                        <option value="1">Activo</option>
                    </select>
                    <x-input-error :messages="$errors->first('form.estatus')" class="mt-2" />
                </div>

                <div x-show="materia == 1">
                    <label class="label" for="idMateria">Materia</label>
                    <select name="idMateria" id="idMateria" wire:model.live="form.idMateria" class="input-cursos"
                        x-bind:disabled="nombre == ''">
                        @if (count($searchMateria) == 0)
                            <option value="0">Ingresa el nombre de la materia</option>
                        @else
                            <option value="0">Selecciona una opción</option>
                            @foreach ($searchMateria as $materia)
                                <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                    <x-input-error :messages="$errors->first('form.idMateria')" class="mt-2" />
                </div>
            </div>

            {{-- error en base de datos --}}
            @session('errorDb')
                <div class="bg-red-100 mt-5">
                    <h2 class="bg-red-500 text-white text-xl pl-2">Error en DB:</h2>
                    <p class="p-4">
                        {{ Session::get('errorDb') }}
                    </p>
                </div>
            @endsession
        </x-slot>

        <x-slot name="buttons">
            <x-primary-button class="button-primary-cursos">
                Guardar
            </x-primary-button>
            <x-secondary-button wire:click="$dispatch('closeModal')" class="button-secondary-cursos">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-slot>
</x-modal>
