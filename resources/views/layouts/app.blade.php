<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Escolar') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-50 text-gray-800 antialiased" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">

        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm md:hidden" style="display: none;">
        </div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 flex flex-col justify-between shadow-lg transform transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:shadow-sm">
            <div>
                <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                        <div class="bg-gradient-to-tr from-blue-600 to-indigo-500 text-white p-2 rounded-xl shadow-md">
                        </div>
                        <span class="font-bold text-lg text-gray-900 tracking-tight">Sistema Escolar</span>
                    </a>
                    <button @click="sidebarOpen = false"
                        class="md:hidden text-gray-400 hover:text-gray-600 font-bold text-xl">
                        &times;
                    </button>
                </div>

                <nav class="p-4 space-y-1 font-medium text-sm">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Dashboard
                    </a>
                    <a href="{{ route('roles.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('roles.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Roles
                    </a>
                    <a href="{{ route('usuarios.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('usuarios.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Usuarios
                    </a>
                    <a href="{{ route('personas.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('personas.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Personas
                    </a>
                    <a href="{{ route('docentes.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('docentes.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Docentes
                    </a>
                    <a href="{{ route('estudiantes.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('estudiantes.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Estudiantes
                    </a>
                    <a href="{{ route('gestiones.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('gestiones.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Gestiones
                    </a>
                    <a href="{{ route('niveles.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('niveles.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Niveles
                    </a>
                    <a href="{{ route('grados.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('grados.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Grados
                    </a>
                    <a href="{{ route('materias.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('materias.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Materias
                    </a>
                    <a href="{{ route('asignaciones.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('asignaciones.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Asignaciones
                    </a>
                    <a href="{{ route('asistencias.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition {{ request()->routeIs('asistencias.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-gray-100' }}">
                        <span class="mr-3 text-lg"></span> Asistencias
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-gray-100 text-xs text-center text-gray-400">
                Panel Administrativo v1.0
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">

            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-200 px-4 md:px-8 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center space-x-3">
                    <button @click="sidebarOpen = true"
                        class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none p-2 rounded-xl hover:bg-gray-100 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight">
                        @isset($header)
                            {{ $header }}
                        @else
                            Panel General
                        @endisset
                    </h2>
                </div>

                <div class="flex items-center space-x-3 md:space-x-4">
                    <div class="flex items-center space-x-3 bg-gray-50 px-3 py-1.5 rounded-full border border-gray-200">
                        <div
                            class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            {{ substr(Auth::user()->email ?? 'A', 0, 1) }}
                        </div>
                        <span
                            class="text-sm font-semibold text-gray-700 hidden sm:inline">{{ Auth::user()->email ?? 'Admin' }}</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-red-600 hover:bg-red-50 px-3 py-2 rounded-xl transition">
                            Salir
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-8 overflow-y-auto">
                {{ $slot }}
            </main>

            <footer class="bg-white border-t border-gray-200 py-6 px-8 text-center text-sm text-gray-500">
                <p>&copy; Sistema Escolar. Desarrollado por Jorge A. Chuquimia Apaza</p>
            </footer>

        </div>
    </div>
</body>

</html>
