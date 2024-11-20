<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grupos') }}
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
        <div class="flex sm:w-3/4 mx-auto relative">
            <input type="text" name="buscador" id="buscador" wire:model.live="search"
                class="ps-10 p-2.5 pr-14 input-cursos" placeholder="Buscador">
            <div class="absolute top-1 right-1">
                {{-- agregar un nuevo registro --}}
                <button type="button"
                    onclick="Livewire.dispatch('openModal', { component: 'cursos.coordinacion.grados.grados-registro' })"
                    class="button-normal">
                    <div>
                        <?xml version="1.0"?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30px"
                            height="30px">
                            <path
                                d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M21,16h-5v5 c0,0.553-0.448,1-1,1s-1-0.447-1-1v-5H9c-0.552,0-1-0.447-1-1s0.448-1,1-1h5V9c0-0.553,0.448-1,1-1s1,0.447,1,1v5h5 c0.552,0,1,0.447,1,1S21.552,16,21,16z" />
                        </svg>
                    </div>

                </button>
            </div>
            <div class="absolute top-3 right-12">
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

        <div class="mt-5">
            @if ($grupos->first())
                <div class="grid sm:grid-cols-4 gap-4">
                    @foreach ($grupos as $grupo)
                        <div class="flex flex-col">
                            <div class="bg-moradoClaro-200">
                                <div class="bg-moradoClaro-600 p-2">
                                    <h3 class="text-white">
                                        Grupo
                                    </h3>
                                </div>
                                <div class="flex justify-between items-center gap-x-4 p-2 ">
                                    <div class="w-3/5">
                                        <p>{{ $grupo->nombre }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col gap-y-2 w-2/5">
                                        <button type="button"
                                            wire:click="$dispatch('openModal', { component: 'cursos.coordinacion.grados.grados-registro', arguments: { id: {{ $grupo->id }}, formAction: 'update' } })"
                                            class="button-primary-cursos p-1 rounded-lg">
                                            Editar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- paginador --}}
                <div class="sm:w-4/5 w-full mt-5">
                    {{ $grupos->links() }}
                </div>
            @else
                {{-- si no hay ningun registro --}}
                <div class="flex justify-center mt-10 text-moradoFuerte-700 text-2xl font-bold">
                    No hay grupos
                </div>
            @endif
        </div>
    </div>
</div>
