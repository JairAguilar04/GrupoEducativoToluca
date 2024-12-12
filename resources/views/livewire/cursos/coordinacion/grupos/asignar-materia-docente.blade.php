<x-modal>
    <x-slot name="title">
        Asignar materia a docente
    </x-slot>

    {{-- formulario --}}
    <x-slot name="formAction">
        {{ $formAction }}
        <x-slot name="content">
            <div class="flex flex-col gap-y-5">
                <div class="w-full">
                    <x-input-label for="idMateria" :value="__('Materia')" />
                    <select name="idMateria" id="idMateria" wire:model.live="idMateria" class="input-cursos">
                        <option value="0">Seleciona una opción</option>
                        @foreach ($materias as $materia)
                            <option value="{{ $materia->materias->id }}"
                                wire:click="addMateria({{ $materia->materias->id }}, '{{ $materia->materias->nombre }}' )">
                                {{ $materia->materias->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->first('idMateria')" class="mt-2" />
                </div>
            </div>

            {{-- idDocente --}}
            <div class="flex flex-col gap-y-5">
                <div class="w-full">
                    <x-input-label for="idDocente" :value="__('Docente')" />
                    <select name="idDocente" id="idDocente" wire:model.live="idDocente" class="input-cursos">
                        <option value="">Seleciona una opción</option>
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}"
                                wire:click="addDocente('{{ $docente->id }}', '{{ $docente->nombres . ' ' . $docente->apellido_paterno . ' ' . $docente->apellido_materno }}')">
                                {{ $docente->nombres . ' ' . $docente->apellido_paterno . ' ' . $docente->apellido_materno }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->first('idDocente')" class="mt-2" />
                </div>
            </div>
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
