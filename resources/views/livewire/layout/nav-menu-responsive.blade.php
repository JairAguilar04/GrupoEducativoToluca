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

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <img class="w-10 h-10 p-1 rounded-full bg-moradoClaro-400 mx-auto mt-6"
                            src="{{ asset(auth()->user()->url_foto) }}" alt="{{ auth()->user()->nombres }}">

                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-transparent hover:text-gray-700 focus:outline-none button-normal transition ease-in-out duration-150">
                            {{-- <div x-data="{{ json_encode(['name' => auth()->user()->nombres]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div> --}}
                            <div class="font-medium text-sm text-gray-500">
                                {{ auth()->user()->nombres . ' ' . auth()->user()->apellido_paterno }}
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- <x-dropdown-link :href="route('/alumnos')">
                            {{ __('Perfil') }}
                        </x-dropdown-link> --}}

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('cursos.grupos')" :active="request()->routeIs('cursos.grupos', 'cursos.grupos.registro')" wire:navigate>
                {{ __('Grupos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cursos.grados')" :active="request()->routeIs('cursos.grados')" wire:navigate>
                {{ __('Grados academicos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cursos.materias')" :active="request()->routeIs('cursos.materias')" wire:navigate>
                {{ __('Materias') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('alumnos.cursos')" :active="request()->routeIs('alumnos.cursos', 'alumnos.registro')" wire:navigate>
                {{ __('Alumnos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cursos.docentes')" :active="request()->routeIs('cursos.docentes', 'cursos.docentes.registro')" wire:navigate>
                {{ __('Docentes') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    {{ auth()->user()->nombres . ' ' . auth()->user()->apellido_paterno }}</div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                {{-- <x-responsive-nav-link :href="route('/')" wire:navigate>
                    {{ __('Perfil') }}
                </x-responsive-nav-link> --}}


                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
