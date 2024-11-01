<x-modal>
    <x-slot name="title">
        Agregar grado académico
    </x-slot>
    holanda

    <x-slot name="formAction">
        <x-slot name="content">
            <div class="flex flex-col gap-y-5">
                <div class="w-full">
                    <x-input-label for="color" :value="__('Nivel académico')" />
                    <select name="color" id="color" class="input-cursos">
                        <option value="">Seleciona una opción</option>
                        @foreach ($niveles as $nivel)
                            <option value="">
                                {{ $nivel->nombre == 'Cursos licenciatura (2da etapa)' ? 'Licenciaturas' : $nivel->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->first('form.color')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label for="nombre" :value="__('Nombre del grado académico')" />
                    <textarea name="nombre" id="nombre" cols="30" rows="2" wire:model.live="form.nombre"
                        class="textarea-cursos" placeholder="Nombre del grado académico" autofocus="autofocus"></textarea>
                    <x-input-error :messages="$errors->first('form.nombre')" class="mt-2" />
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
