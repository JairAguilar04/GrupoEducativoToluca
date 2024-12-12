<x-modal>
    <x-slot name="title">
        <div x-data="{ listaAlumnos: $wire.entangle('listAlumnos') }">
            Asignar alumnos
        </div>
    </x-slot>

    {{-- formulario --}}
    <x-slot name="formAction">
        {{ $formAction }}
        <x-slot name="content">
            <div x-data="{ mensaje: $wire.entangle('mensaje') }" class="flex flex-col gap-y-5">
                {{-- mensaje de advertencia --}}
                <div x-show="mensaje != '' " class="bg-yellow-300 border-l-4 border-yellow-600 p-2 rounded-r-md">
                    <p x-text="mensaje"></p>
                </div>

                <div class="w-full">
                    <x-input-label for="alumnos" :value="__('Alumnos')" />
                    <div x-data="{
                        search: '',
                        items: @js($collection),
                    
                        get filteredItems() {
                            return this.items.filter(
                                (i) => i.nombres.startsWith(this.search)
                            )
                        }
                    }">
                        <input x-model="search" id="alumnos" placeholder="Buscar alumnos" class="input-cursos" />
                        <ul class="flex flex-col gap-y-2 mt-5">
                            <template x-for="(alumno, i) in filteredItems">
                                <div x-show="i < 5">
                                    <p x-text="alumno.nombres + ' ' + alumno.apellido_paterno + ' ' + alumno.apellido_materno"
                                        wire:click="addAlumnos(alumno.id, alumno.nombres + ' ' + alumno.apellido_paterno + ' ' + alumno.apellido_materno)"
                                        class="rounded-md border border-moradoClaro-200 p-2 w-full cursor-pointer hover:bg-moradoClaro-200">
                                    </p>
                                </div>
                            </template>
                        </ul>
                    </div>
                    <x-input-error :messages="$errors->first('listAlumnos')" class="mt-2" />
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
