<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grados academicos') }}
        </h2>
    </x-slot>
    <div>
        <x-secondary-button
            onclick="Livewire.dispatch('openModal', { component: 'cursos.coordinacion.grados.grados-registro' })"
            class="bg-moradoClaro-500 text-white">
            Agregar grado
        </x-secondary-button>
    </div>
</div>
