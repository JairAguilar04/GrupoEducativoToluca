<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coordinacion de cursos') }}
        </h2>
    </x-slot>

    <div>

        {{-- buscador --}}
        <div class="flex sm:w-3/4 mx-auto relative">
            <input type="text" name="buscador" id="buscador" wire:model.live="search"
                class="ps-10 p-2.5 pr-14 input-cursos" placeholder="Buscador">
            <div class="absolute -top-1 -right-4">
                {{-- agregar un nuevo registro --}}
                <button
                    onclick="Livewire.dispatch('openModal', { component: 'modals.agregar-heroe', arguments: { formAction: 'save', accion: 2 }  })"
                    class="button" title="Agregar heroe">
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
                    <button type="button" wire:click="limpiarBuscador()">
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

        @if ($usuarios->first())
            <div class="overflow-x-auto mt-4">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-sm">
                            <th class="w-[20%] cursor-pointer" wire:click="ordenarColumna('apellido_paterno')">
                                Nombre<span class="pl-1 text-green-400 font-bold">&#8645;</span>
                            </th>
                            <th class="w-[15%] cursor-pointer" wire:click="ordenarColumna('matricula')">
                                Matricula<span class="pl-1 text-green-400 font-bold">&#8645;</span>
                            </th>
                            <th class="w-[20%] cursor-pointer" wire:click="ordenarColumna('email')">
                                Correo electrónico<span class="pl-1 text-green-400 font-bold">&#8645;</span>
                            </th>
                            <th class="w-[15%]">
                                Estatus
                            </th>
                            <th class="w-[15%]">
                                Foto
                            </th>

                            <th class="w-[15%]">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($usuarios as $usuario)
                            <tr class="border-b-gray-200 border-bg-gray-800 text-center">
                                <td>
                                    {{ $usuario->apellido_paterno . ' ' . $usuario->apellido_materno . ' ' . $usuario->nombres }}
                                </td>
                                <td>{{ $usuario->matricula }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @if ($usuario->estatus_id == 1)
                                        <p class="mx-2 px-2 border border-green-700 bg-green-100 rounded-xl">
                                            {{ $usuario->estatus->nombre }}
                                        </p>
                                    @elseif ($usuario->estatus_id == 3)
                                        <p class="mx-2 px-2 border border-yellow-700 bg-yellow-100 rounded-xl">
                                            {{ $usuario->estatus->nombre }}
                                        </p>
                                    @endif
                                </td>
                                <td>Sin foto</td>
                                <td class="flex sm:flex-row flex-col sm:gap-x-2 gap-y-2">
                                    <button>Editar</button>
                                    <button>Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- paginador --}}
            <div class="sm:w-4/5 w-full mt-5">
                {{ $usuarios->links() }}
            </div>
        @else
            {{-- si no hay ningun registro --}}
            <div class="flex justify-center mt-10 text-azul-600 text-2xl font-bold">
                No hay registros
            </div>
        @endif

    </div>
</div>
