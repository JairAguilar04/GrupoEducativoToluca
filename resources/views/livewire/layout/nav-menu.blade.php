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

<nav x-data="{ open: false }" class="bg-white border-r-2 border-gray-100 w-full">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl">
        <div class="flex justify-center">
            <div class="flex flex-col gap-y-5 items-center w-full">
                <!-- Logo -->
                {{-- <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div> --}}

                <div class="mt-2">
                    Menú
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex flex-col w-full pl-4 gap-y-1 bg-gray-100 px-5">
                    <x-nav-link :href="route('alumnos.cursos')" :active="request()->routeIs('')" wire:navigate>
                        {{ __('Grupos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('alumnos.cursos')" :active="request()->routeIs('')" wire:navigate>
                        {{ __('Grados') }}
                    </x-nav-link>
                    <x-nav-link :href="route('alumnos.cursos')" :active="request()->routeIs('')" wire:navigate>
                        {{ __('Materias') }}
                    </x-nav-link>
                    <x-nav-link :href="route('alumnos.cursos')" :active="request()->routeIs('alumnos.cursos', 'alumnos.registro')" wire:navigate>
                        {{ __('Alumnos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cursos.docentes')" :active="request()->routeIs('cursos.docentes', 'cursos.docentes.registro')" wire:navigate>
                        {{ __('Docentes') }}
                    </x-nav-link>
                    <x-nav-link :href="route('alumnos.cursos')" :active="request()->routeIs('')" wire:navigate>
                        {{ __('Calificaciones') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>
