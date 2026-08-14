<div x-show="openCreateModal" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 w-full h-full flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4"
    style="display: none; top:-24px;">
    <div @click.away="openCreateModal = false"
        class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 border border-gray-100">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Registrar Nuevo Estudiante</h3>
            <button @click="openCreateModal = false"
                class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
        </div>

        <form action="{{ route('estudiantes.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Seleccionar Persona</label>
                <select name="persona_id" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">Seleccione...</option>
                    @foreach ($personas as $persona)
                        <option value="{{ $persona->id_persona }}">{{ $persona->nombres }} {{ $persona->apellidos }}
                            (CI: {{ $persona->ci }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Código RUDE</label>
                <input type="text" name="rude" required placeholder="Número RUDE"
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nivel</label>
                <select name="nivel_id" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">Seleccione...</option>
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id_nivel }}">{{ $nivel->nivel }} - Turno: {{ $nivel->turno }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Grado / Curso</label>
                <select name="grado_id" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">Seleccione...</option>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id_grado }}">{{ $grado->curso }} - Paralelo: {{ $grado->paralelo }}
                        </option>
                    @endforeach
                </select>
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
