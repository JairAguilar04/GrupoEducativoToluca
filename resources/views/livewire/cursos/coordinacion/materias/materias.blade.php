<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materias') }}
        </h2>
    </x-slot>

    <div>

        <x-secondary-button
            onclick="Livewire.dispatch('openModal', { component: 'cursos.coordinacion.materias.materias-registro' })"
            class="bg-moradoClaro-500 text-white">
            Agregar materia
        </x-secondary-button>

        <div class="grid grid-cols-4 gap-4 mt-8">
            @foreach ($materias as $materia)
                <div
                    class="@if ($materia->color == 'ROJO') bg-red-300 @elseif($materia->color == 'AZUL') bg-blue-300 @elseif($materia->color == 'MORADO') bg-purple-300 @elseif($materia->color == 'ROSA') bg-pink-300 @elseif($materia->color == 'VERDE') bg-green-300 @elseif($materia->color == 'ANARANJADO') bg-orange-300 @else bg-moradoClaro-300 @endif
                    rounded-md rounded-t-none w-full">
                    <p
                        class="text-center @if ($materia->color == 'ROJO') bg-red-500 @elseif($materia->color == 'AZUL') bg-blue-500 @elseif($materia->color == 'MORADO') bg-purple-500 @elseif($materia->color == 'ROSA') bg-pink-500 @elseif($materia->color == 'VERDE') bg-green-500 @elseif($materia->color == 'ANARANJADO') bg-orange-500 @else bg-moradoClaro-500 @endif text-white p-2">
                        {{ $materia->nombre }}</p>
                    <div class="flex justify-end items-center gap-x-1 text-white pr-4 mt-2">
                        @if ($materia->estatus == 1)
                            <p class="w-3 h-3 bg-green-500 block rounded-full"></p>
                        @else
                            <p class="w-3 h-3 bg-red-500 block rounded-full"></p>
                        @endif
                        <p class="">{{ $materia->estatus == 1 ? 'Activa' : 'Desactivada' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
