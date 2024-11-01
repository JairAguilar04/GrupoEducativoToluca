<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Grupo Educativo Toluca</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div x-data="{ open: true }" class="w-full">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white border-b-2 border-gray-400 shadow flex justify-between sm:h-20">
                    <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 flex sm:flex-row flex-col items-center gap-x-4">

                        <div>
                            <button @click="open = ! open" x-text="open ? 'Ocultar' : 'Ver' "
                                class="button-normal button-normal-color sm:block hidden"></button>
                        </div>

                        <!-- Logo -->
                        <div class="shrink-0 sm:flex hidden">
                            <a href="{{ route('alumnos.cursos') }}" wire:navigate>
                                <img src="{{ asset('img/logos/logoApp.png') }}" alt="Grupo Educativo Toluca"
                                    class="w-20">
                            </a>
                        </div>

                        {{-- Titulo --}}
                        {{ $header }}

                    </div>

                    <div>
                        <livewire:layout.nav-menu-responsive />
                    </div>

                </header>
            @endif

            <div class="flex">
                <div x-show="open" class="sm:w-72 sm:flex hidden bg-gray-300 h-screen">
                    <livewire:layout.nav-menu />
                </div>

                <div class="w-full">
                    <!-- Page Content -->
                    <main>
                        <div class="py-6">
                            <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
    @livewire('wire-elements-modal')
</body>

</html>
