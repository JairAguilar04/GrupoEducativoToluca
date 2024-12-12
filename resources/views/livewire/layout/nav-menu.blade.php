<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-transparent border-r-2 border-gray-100 w-full">
    <!-- Primary Navigation Menu -->
    <div class="">
        <div class="flex justify-center">
            <div class="flex flex-col items-center w-full">
                <!-- Logo -->
                {{-- <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div> --}}

                <div
                    class="bg-moradoClaro-300 rounded-r-xl rounded-l-none rounded-b-none w-full text-center text-moradoFuerte-700 font-bold text-xl">
                    Menú
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex flex-col w-full h-screen pl-4 gap-y-1 bg-[#e6e6e6] px-5">
                    <x-nav-link :href="route('cursos.grupos')" :active="request()->routeIs('cursos.grupos', 'cursos.grupos.registro')" wire:navigate>
                        {{ __('Grupos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cursos.grados')" :active="request()->routeIs('cursos.grados')" wire:navigate>
                        {{ __('Grados academicos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cursos.materias')" :active="request()->routeIs('cursos.materias')" wire:navigate>
                        {{ __('Materias') }}
                    </x-nav-link>
                    <x-nav-link :href="route('alumnos.cursos')" :active="request()->routeIs('alumnos.cursos', 'alumnos.registro')" wire:navigate>
                        {{ __('Alumnos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cursos.docentes')" :active="request()->routeIs('cursos.docentes', 'cursos.docentes.registro')" wire:navigate>
                        {{ __('Docentes') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>
