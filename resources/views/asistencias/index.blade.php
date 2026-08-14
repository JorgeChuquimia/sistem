<x-app-layout>
    <x-slot name="header">
        {{ __('Registro de Asistencias') }}
    </x-slot>

    <div class="space-y-6" x-data="{
        openCreateModal: false,
        openEditModal: false,
        openDeleteModal: false,
        editId: '',
        editEstudianteId: '',
        editDocenteId: '',
        editMateriaId: '',
        editFecha: '',
        editEstado: '',
        editObservacion: '',
        deleteId: ''
    }">

        {{-- Alertas --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm shadow-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button @click="show = false"
                    class="text-emerald-500 hover:text-emerald-700 font-bold ml-4">&times;</button>
            </div>
        @endif

        {{-- Tabla de Asistencias --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800 text-lg">Lista de Asistencias</h3>
                <button @click="openCreateModal = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-4 py-2.5 rounded-xl shadow-md transition">
                    + Registrar Asistencia
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Estudiante
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Docente</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Materia</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm">
                        @forelse ($asistencias as $asistencia)
                            <tr>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $asistencia->estudiante->persona->nombres ?? '' }}
                                    {{ $asistencia->estudiante->persona->apellidos ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $asistencia->docente->persona->nombres ?? '' }}
                                    {{ $asistencia->docente->persona->apellidos ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $asistencia->materia->nombre_materia ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $asistencia->fecha }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $asistencia->estado ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                                        {{ $asistencia->estado ? 'Presente' : 'Falta' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    {{-- Botón Editar --}}
                                    <button
                                        @click="
                                            openEditModal = true;
                                            editId = '{{ $asistencia->id_asistencia }}';
                                            editEstudianteId = '{{ $asistencia->estudiante_id }}';
                                            editDocenteId = '{{ $asistencia->docente_id }}';
                                            editMateriaId = '{{ $asistencia->materia_id }}';
                                            editFecha = '{{ $asistencia->fecha }}';
                                            editEstado = '{{ $asistencia->estado }}';
                                            editObservacion = '{{ $asistencia->observacion }}';
                                        "
                                        class="text-amber-600 hover:text-amber-900 font-medium">Editar</button>

                                    {{-- Botón Eliminar --}}
                                    <button
                                        @click="openDeleteModal = true; deleteId = '{{ $asistencia->id_asistencia }}'"
                                        class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay registros.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Inclusión de Modales --}}
        @include('asistencias.modals.create')
        @include('asistencias.modals.edit')
        @include('asistencias.modals.delete')
    </div>
</x-app-layout>
