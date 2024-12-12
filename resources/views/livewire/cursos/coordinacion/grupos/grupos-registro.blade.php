<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar grupo') }}
        </h2>
    </x-slot>
    <div>
        <form wire:submit="save">
            @csrf
            <div x-data="{ nivel: $wire.entangle('form.idNivel'), grado: $wire.entangle('form.idGrado') }" class="flex flex-col gap-y-8">
                {{-- nivel y grado --}}
                <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                    <div class="sm:w-1/4 w-full">
                        <x-input-label for="idNivel" :value="__('Nivel académico')" />
                        <select name="idNivel" id="idNivel" wire:model.live="form.idNivel"
                            wire:change="limpiarCampo('nivel')" class="input-cursos">
                            <option value="0">Selecciona una opción</option>
                            @foreach ($niveles as $grado)
                                <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->first('form.idNivel')" class="mt-2" />
                    </div>
                    <div class="sm:w-3/4 w-full">
                        <x-input-label for="grado" :value="__('Grado académico')" />
                        <select name="grado" id="grado" wire:model.live="form.idGrado"
                            wire:change="limpiarCampo('grado')" class="input-cursos" :disabled="nivel == 0"
                            :title="nivel == 0 ? 'Selecciona un nivel académico.' : ''">
                            <option value="0">Selecciona una opción</option>
                            @foreach ($grados as $grado)
                                <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->first('form.idGrado')" class="mt-2" />
                    </div>
                </div>

                {{-- asignar docentes a materias --}}
                <div x-data="{ listDocente: $wire.entangle('form.lisDocentes'), mensaje: $wire.entangle('mensaje') }" class="flex flex-col gap-y-5">
                    <div class="flex flex-row gap-x-5 w-full justify-between">
                        <div class="sm:w-1/3 w-full flex items-end gap-x-2">
                            <p class="label">Asignar materias a docentes<span class="text-red-600 font-bold">*</span>
                            </p>
                            <button type="button"
                                wire:click="$dispatch('openModal', { component: 'cursos.coordinacion.grupos.asignar-materia-docente', arguments: { idNivel: {{ $form->idNivel }}, idGrado: {{ $form->idGrado }} } })"
                                class="button-normal button-primary-cursos w-8 h-8 rounded-full"
                                :disabled="grado == 0 || grado == null"
                                :title="grado == 0 ? 'Selecciona un grado académico.' : ''">+</button>
                        </div>

                        <div x-show="mensaje != '' "
                            class="bg-yellow-300 border-l-4 border-yellow-600 p-2 rounded-r-md">
                            <p x-text="mensaje"></p>
                        </div>
                    </div>

                    <div x-show="listDocente != null && listDocente != '' " class="sm:w-5/6 w-full mx-auto">
                        <div class="overflow-x-auto mt-4">
                            <table class="w-full table-auto text-sm">
                                <thead class="bg-moradoClaro-500 text-white">
                                    <tr>
                                        <th class="w-[40%]">Materia</th>
                                        <th class="w-[40%]">Docente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($form->lisDocentes))
                                        @foreach ($form->lisDocentes as $docente)
                                            <tr class="tr-par-cursos tr-impar-cursos">
                                                <td>{{ $docente['nombre_materia'] }}</td>
                                                <td>{{ $docente['nombre_docente'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->first('form.lisDocentes')" />
                </div>

                {{-- turno, capacidad y color --}}
                <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                    <div class="sm:w-1/3 w-full">
                        <x-input-label for="turno" :value="__('Turno')" />
                        <select name="turno" id="turno" wire:model.live="form.turno" class="input-cursos">
                            <option value="">Selecciona una opción</option>
                            @foreach ($turnos as $turno => $key)
                                <option value="{{ $key }}">{{ $key }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->first('form.turno')" class="mt-2" />
                    </div>
                    <div class="sm:w-1/3 w-full">
                        <x-input-label for="capacidad" :value="__('Capacidad')" />
                        <input type="number" name="capacidad" id="capacidad" wire:model.live="form.capacidad"
                            class="input-cursos" placeholder="Capacidad del grupo" min="0" />
                        <x-input-error :messages="$errors->first('form.capacidad')" class="mt-2" />
                    </div>
                    <div class="sm:w-1/3 w-full">
                        <x-input-label for="color" :value="__('Color')" />
                        <select name="color" id="color" wire:model.live="form.color" class="input-cursos">
                            <option value="">Selecciona una opción</option>
                            @foreach ($colores as $color => $key)
                                <option value="{{ $key }}">{{ $key }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->first('form.color')" class="mt-2" />
                    </div>
                </div>

                {{-- alumnos --}}
                <div x-data="{ listaAlumnos: $wire.entangle('form.listAlumnos'), capacidad: $wire.entangle('form.capacidad') }" class="flex flex-col gap-y-5">
                    <div class="flex sm:flex-row flex-col sm:items-center sm:gap-x-5 gap-y-5 w-full">
                        <div class="sm:w-1/3 w-full flex items-end gap-x-2">
                            <p class="label">Agregar alumnos<span class="text-red-600 font-bold">*</span></p>

                            <button type="button"
                                wire:click="$dispatch('openModal', { component: 'cursos.coordinacion.grupos.asignar-alumnos', arguments: { idNivel: {{ $form->idNivel }}, capacidad: {{ $form->capacidad }} } })"
                                class="button-normal button-primary-cursos w-8 h-8 rounded-full"
                                :disabled="(grado == 0 || grado == null || capacidad < 1 || capacidad > 100)"
                                :title="grado == 0 || capacidad < 1 ?
                                    'El grado académico y la capacidad del grupo no pueden estar vacios.' : ''">+</button>
                        </div>

                        <div x-show="listaAlumnos.length > 0"
                            class="sm:w-8/12 w-full h-44 overflow-y-auto cursor-n-resize p-4 rounded-md bg-moradoClaro-200">
                            <h2
                                x-text="listaAlumnos.length <= 1 ? listaAlumnos.length + ' alumno asignado'  : listaAlumnos.length + ' alumnos asignados' ">
                            </h2>
                            <ol class="list-disc sm:pl-8 pl-2 mt-4 grid grid-cols-2 gap-x-5">
                                @foreach ($form->listAlumnos as $alumno)
                                    <li>{{ $alumno['nombre'] }}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>

                    <div class="-mt-5">
                        <x-input-error :messages="$errors->first('form.listAlumnos')" />
                    </div>
                </div>

                {{-- periodo --}}
                <h2 class="-mb-5 font-semibold">Periodo del curso</h2>
                <div class="flex sm:flex-row flex-col sm:gap-x-5 gap-y-5">
                    <div class="sm:w-1/2 w-full">
                        <x-input-label for="fechaInicio" :value="__('Fecha de inicio')" />
                        <input type="date" name="fechaInicio" id="fechaInicio" wire:model.live="form.fechaInicio"
                            class="input-cursos" />
                        <x-input-error :messages="$errors->first('form.fechaInicio')" class="mt-2" />
                    </div>
                    <div class="sm:w-1/2 w-full">
                        <x-input-label for="fechaFinal" :value="__('Fecha final')" />
                        <input type="date" name="fechaFinal" id="fechaFinal" wire:model.live="form.fechaFinal"
                            class="input-cursos" />
                        <x-input-error :messages="$errors->first('form.fechaFinal')" class="mt-2" />
                    </div>
                </div>
            </div>

            {{-- botones --}}
            <div class="flex sm:flex-row flex-col sm:justify-end justify-center mt-5">
                <x-secondary-button class="button-secondary-cursos">
                    <a href="/cursos/alumnos">Regresar</a>
                </x-secondary-button>
                {{-- es un nuevo registro --}}
                <x-primary-button class="button-primary-cursos">Guardar</x-primary-button>
            </div>
        </form>
    </div>

    {{-- errores en formulario --}}
    @if ($errors->any())
        <div class="bg-moradoClaro-100 mt-5">
            <h2 class="bg-moradoClaro-400 text-white text-xl pl-2">Faltan campos por completar:</h2>
            <p class="p-4">
                Comprueba que todos los campos esten llenos o que cumplan con el formato solicitado, todos los
                campos
                con <span class="text-red-600 font-bold">*</span> son requeridos.
            </p>
        </div>
    @endif

    {{-- error en base de datos --}}
    @session('errorDb')
        <div class="bg-red-100 mt-5">
            <h2 class="bg-red-500 text-white text-xl pl-2">Error en DB:</h2>
            <p class="p-4">
                {{ Session::get('errorDb') }}
            </p>
        </div>
    @endsession

</div>
