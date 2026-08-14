<x-app-layout>
    <x-slot name="header">
        {{ __('Gestión de Estudiantes') }}
    </x-slot>

    <div class="space-y-6" x-data="{
        openCreateModal: false,
        openEditModal: false,
        openDeleteModal: false,
        editId: '',
        editPersonaId: '',
        editNivelId: '',
        editGradoId: '',
        editRude: '',
        deleteId: '',
        deleteNombre: ''
    }">

        <!-- Alerta de Éxito -->
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm shadow-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button @click="show = false"
                    class="text-emerald-500 hover:text-emerald-700 font-bold ml-4">&times;</button>
            </div>
        @endif

        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm shadow-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>&bull; {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800 text-lg">Lista de Estudiantes Registrados</h3>

                <button @click="openCreateModal = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-md shadow-blue-500/20 transition">
                    + Nuevo Estudiante
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nombre
                                Completo</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">RUDE</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nivel</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Grado /
                                Paralelo</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm">
                        @forelse ($estudiantes as $estudiante)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 font-medium">
                                    {{ $estudiante->id_estudiante }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                    {{ $estudiante->persona->nombres ?? '' }}
                                    {{ $estudiante->persona->apellidos ?? 'Sin Persona' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    <span
                                        class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-50 text-sky-700">
                                        {{ $estudiante->rude }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    {{ $estudiante->nivel->nivel ?? '-' }} ({{ $estudiante->nivel->turno ?? '-' }})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    {{ $estudiante->grado->curso ?? '-' }} -
                                    "{{ $estudiante->grado->paralelo ?? '-' }}"
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right space-x-3">
                                    <button
                                        @click="openEditModal = true; 
                                                editId = '{{ $estudiante->id_estudiante }}'; 
                                                editPersonaId = '{{ $estudiante->persona_id }}'; 
                                                editNivelId = '{{ $estudiante->nivel_id }}'; 
                                                editGradoId = '{{ $estudiante->grado_id }}'; 
                                                editRude = '{{ $estudiante->rude }}'"
                                        class="text-indigo-600 hover:text-indigo-900 font-medium">
                                        Editar
                                    </button>

                                    <button
                                        @click="openDeleteModal = true; deleteId = '{{ $estudiante->id_estudiante }}'; deleteNombre = '{{ $estudiante->persona->nombres ?? '' }} {{ $estudiante->persona->apellidos ?? '' }}'"
                                        class="text-red-600 hover:text-red-900 font-medium">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay estudiantes
                                    registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Inclusión de Modales -->
        @include('estudiantes.modals.create')
        @include('estudiantes.modals.edit')
        @include('estudiantes.modals.delete')

    </div>
</x-app-layout>
