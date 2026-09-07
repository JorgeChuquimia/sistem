<div x-show="openCreateModal" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 w-full h-full flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4"
    style="display: none; top:-24px;">
    <div @click.away="openCreateModal = false"
        class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 border border-gray-100">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Registrar Asistencia</h3>
            <button @click="openCreateModal = false"
                class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
        </div>

        {{-- Alerta de errores de validación (Muestra el mensaje de duplicado) --}}
        @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('asistencias.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Selector de Estudiante --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estudiante</label>
                <select name="estudiante_id" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">Seleccione un estudiante...</option>
                    @foreach ($estudiantes as $estudiante)
                    <option value="{{ $estudiante->id_estudiante }}" {{ old('estudiante_id') == $estudiante->id_estudiante ? 'selected' : '' }}>
                        {{ $estudiante->persona->nombres ?? '' }} {{ $estudiante->persona->apellidos ?? '' }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Selector o campo fijo de Docente --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Docente</label>
                @if(Auth::user()->docente)
                <input type="hidden" name="docente_id" value="{{ Auth::user()->docente->id_docente }}">
                <input type="text" disabled value="{{ Auth::user()->docente->persona->nombres ?? '' }} {{ Auth::user()->docente->persona->apellidos ?? '' }} (RDA: {{ Auth::user()->docente->rda ?? '' }})"
                    class="w-full rounded-xl border-gray-200 bg-gray-100 shadow-sm text-sm text-gray-600 cursor-not-allowed">
                @else
                <select name="docente_id" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">Seleccione un docente...</option>
                    @foreach ($docentes as $docente)
                    <option value="{{ $docente->id_docente }}" {{ old('docente_id') == $docente->id_docente ? 'selected' : '' }}>
                        {{ $docente->persona->nombres ?? '' }} {{ $docente->persona->apellidos ?? '' }} (RDA: {{ $docente->rda ?? '' }})
                    </option>
                    @endforeach
                </select>
                @endif
            </div>

            {{-- Selector de Materia --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Materia</label>
                <select name="materia_id" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">Seleccione una materia...</option>
                    @foreach ($materias as $materia)
                    <option value="{{ $materia->id_materia }}" {{ old('materia_id') == $materia->id_materia ? 'selected' : '' }}>
                        {{ $materia->nombre_materia }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
            </div>

            {{-- Estado --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select name="estado" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="Presente" {{ old('estado') == 'Presente' ? 'selected' : '' }}>Presente</option>
                    <option value="Ausente" {{ old('estado') == 'Ausente' ? 'selected' : '' }}>Ausente</option>
                    <option value="Atraso" {{ old('estado') == 'Atraso' ? 'selected' : '' }}>Atraso</option>
                    <option value="Licencia" {{ old('estado') == 'Licencia' ? 'selected' : '' }}>Licencia</option>
                </select>
            </div>

            {{-- Observación (Opcional) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Observación (Opcional)</label>
                <input type="text" name="observacion" value="{{ old('observacion') }}" placeholder="Ej. Atraso justificado"
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" @click="openCreateModal = false"
                    class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-md shadow-blue-500/20">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>