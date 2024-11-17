<x-modal>
    <x-slot name="title">
        Actualizar estatus para {{ $nombre }}
    </x-slot>

    {{-- formulario --}}
    <x-slot name="formAction">
        {{ $formAction }}

        <x-slot name="content">
            <div class="w-full">
                <x-input-label for="estatus" :value="__('Estatus')" />
                <select name="estatus" id="estatus" wire:model.live="estado" class="input-cursos">
                    <option value="0">Seleccione una opción</option>
                    @foreach ($estatus as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->first('estado')" class="mt-2" />
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
