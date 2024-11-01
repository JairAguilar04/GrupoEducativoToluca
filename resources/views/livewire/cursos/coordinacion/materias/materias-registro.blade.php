<x-modal>
    <x-slot name="title">
        Agregar materia
    </x-slot>
    holanda

    <x-slot name="formAction">
        <x-slot name="content">
            <div class="flex flex-col gap-y-5">
                <div class="w-full">
                    <x-input-label for="color" :value="__('Grado')" />
                    <select name="color" id="color" class="input-cursos">
                        <option value="">Seleciona una opción</option>
                        @foreach ($grados as $grado)
                            <option value="">{{ $grado->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->first('form.color')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label for="nombre" :value="__('Nombre de la materia')" />
                    <textarea name="nombre" id="nombre" cols="30" rows="2" wire:model.live="form.nombre"
                        class="textarea-cursos" placeholder="Nombre" autofocus="autofocus"></textarea>
                    <x-input-error :messages="$errors->first('form.nombre')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label for="color" :value="__('Color')" />
                    <select name="color" id="color" class="input-cursos">
                        <option value="">Seleciona una opción</option>
                        <option value="">Rojo</option>
                        <option value="">Verde</option>
                        <option value="">Azul</option>
                        <option value="">Morado</option>
                        <option value="">Rosa</option>
                        <option value="">Amarillo</option>
                        <option value="">Anaranjado</option>
                    </select>
                    <x-input-error :messages="$errors->first('form.color')" class="mt-2" />
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
