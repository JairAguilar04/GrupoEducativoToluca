<x-modal>
    <x-slot name="title">
        {{ $id == 0 ? 'Agregar grado académico' : 'Editar grado académico' }}
    </x-slot>

    {{-- formulario --}}
    <x-slot name="formAction">
        {{ $formAction }}
        <x-slot name="content">
            <div class="flex flex-col gap-y-5">
                <div class="w-full">
                    <x-input-label for="nivel" :value="__('Nivel académico')" />
                    <select name="nivel" id="nivel" wire:model.live="nivelAcademico" class="input-cursos">
                        <option value="0">Seleciona una opción</option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre == 'Cursos licenciatura (2da etapa)' ? 'Licenciaturas' : $nivel->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->first('nivelAcademico')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label for="nombre" :value="__('Nombre del grado académico')" />
                    <textarea name="nombre" id="nombre" cols="30" rows="2" wire:model.live="nombre" class="textarea-cursos"
                        placeholder="Nombre del grado académico" autofocus="autofocus"></textarea>
                    <x-input-error :messages="$errors->first('nombre')" class="mt-2" />
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
