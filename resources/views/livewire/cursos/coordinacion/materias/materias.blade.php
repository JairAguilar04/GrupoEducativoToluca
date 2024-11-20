<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materias') }}
        </h2>
    </x-slot>

    <div>
        {{-- alerta de registro creado, actualizado o eliminado --}}
        @session('success')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    iconColor: '#4a3d62',
                    text: '{{ Session::get('success') }}',
                    confirmButtonColor: '#6c7cc5',
                    confirmButtonText: 'Aceptar',
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        @endsession

        {{-- buscador --}}
        <div class="flex justify-center gap-x-2">
            <div>
                <select name="estatus" id="estatus" wire:model.live="estatus" class="input-cursos">
                    <option value="1">Activas</option>
                    <option value="0">Desactivadas</option>
                </select>
            </div>
            <div class="relative w-3/4">
                <input type="text" name="buscador" id="buscador" wire:model.live="search"
                    class="ps-10 p-2.5 pr-14 input-cursos" placeholder="Buscador">
                <div class="absolute top-1 right-1">
                    {{-- agregar un nuevo registro --}}
                    <button type="button"
                        onclick="Livewire.dispatch('openModal', { component: 'cursos.coordinacion.materias.materias-registro' })"
                        class="button-normal">
                        <div>
                            <?xml version="1.0"?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"
                                width="30px" height="30px">
                                <path
                                    d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M21,16h-5v5 c0,0.553-0.448,1-1,1s-1-0.447-1-1v-5H9c-0.552,0-1-0.447-1-1s0.448-1,1-1h5V9c0-0.553,0.448-1,1-1s1,0.447,1,1v5h5 c0.552,0,1,0.447,1,1S21.552,16,21,16z" />
                            </svg>
                        </div>
                    </button>
                </div>
                <div class="absolute top-3 right-10">
                    {{-- limpiar el buscador --}}
                    @if (!empty($search))
                        <button type="button" wire:click="limpiarBuscador()" class="button-normal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" class="w-5 h-5">
                                <path
                                    d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z" />
                            </svg>
                        </button>
                    @endif
                </div>
                {{-- icono search --}}
                <div class="absolute top-2 left-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" class="w-6 h-6">
                        <path
                            d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z" />
                    </svg>
                </div>
            </div>
        </div>

        <div>
            @if ($materias->first())
                {{-- grid de materias --}}
                <div class="grid grid-cols-4 gap-4 mt-8">
                    @foreach ($materias as $materia)
                        <div
                            class="@if ($materia->color == 'Rojo') bg-red-300 @elseif($materia->color == 'Azul') bg-blue-300 @elseif($materia->color == 'Morado') bg-purple-300 @elseif($materia->color == 'Rosa') bg-pink-300 @elseif($materia->color == 'Verde') bg-green-300 @elseif($materia->color == 'Anaranjado') bg-orange-300 @elseif($materia->color == 'Amarillo') bg-yellow-300 @else bg-moradoClaro-300 @endif
            rounded-md rounded-t-none w-full">
                            <p
                                class="text-center @if ($materia->color == 'Rojo') bg-red-500 @elseif($materia->color == 'Azul') bg-blue-500 @elseif($materia->color == 'Morado') bg-purple-500 @elseif($materia->color == 'Rosa') bg-pink-500 @elseif($materia->color == 'Verde') bg-green-500 @elseif($materia->color == 'Anaranjado') bg-orange-500 @elseif($materia->color == 'Amarillo') bg-yellow-500 @else bg-moradoClaro-500 @endif text-white p-2">
                                {{ $materia->nombre }}
                            </p>

                            <div class="flex justify-between items-center text-white p-4">
                                <div class="flex items-center gap-x-1 font-bold">
                                    @if ($materia->estatus == 1)
                                        <span class="w-3 h-3 bg-green-500 block rounded-full"></span>
                                        <p> Activa</p>
                                    @else
                                        <span class="w-3 h-3 bg-red-500 block rounded-full"></span>
                                        <p> Desactiva</p>
                                    @endif
                                </div>

                                <div>
                                    <button type="button" class="button-primary-cursos p-1 rounded-lg"
                                        wire:click="$dispatch('openModal', { component: 'cursos.coordinacion.materias.materias-registro', arguments: { id: '{{ $materia->id }}', formAction: 'update'  } })"
                                        class="button-normal">
                                        Editar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- paginador --}}
                <div class="sm:px-20 w-full mt-5">
                    {{ $materias->links() }}
                </div>
            @else
                {{-- si no hay ningun registro --}}
                <div class="flex justify-center mt-10 text-moradoFuerte-700 text-2xl font-bold">
                    No hay materias
                </div>
            @endif
        </div>
    </div>
</div>
