<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grados academicos') }}
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


        <x-secondary-button
            onclick="Livewire.dispatch('openModal', { component: 'cursos.coordinacion.grados.grados-registro' })"
            class="bg-moradoClaro-500 text-white">
            Agregar grado
        </x-secondary-button>

        <div class="mt-5">
            <div class="grid sm:grid-cols-4 gap-4">
                @foreach ($grados as $grado)
                    <div class="flex flex-col">
                        <div class="bg-moradoClaro-200">
                            <div class="bg-moradoClaro-600 p-2">
                                <h3 class="text-white">
                                    {{ $grado->nivel->nombre == 'Cursos licenciatura (2da etapa)' ? 'Licenciatura' : $grado->nivel->nombre }}
                                </h3>
                            </div>
                            <div class="flex justify-between items-center gap-x-4 p-4">
                                <div class="w-4/5">
                                    <p>{{ $grado->nombre }}
                                    </p>
                                </div>
                                <div class="w-1/5 bg-yellow-400">
                                    <button type="button"
                                        wire:click="$dispatch('openModal', { component: 'cursos.coordinacion.grados.grados-registro', arguments: { id: {{ $grado->id }}, formAction: 'update' } })"
                                        class="button-normal">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- paginador --}}
            <div class="sm:w-4/5 w-full mt-5">
                {{ $grados->links() }}
            </div>
        </div>

    </div>
</div>
