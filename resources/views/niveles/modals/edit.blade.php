<div x-show="openEditModal" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 w-full h-full flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4"
    style="display: none; top:-24px;">
    <div @click.away="openEditModal = false"
        class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 border border-gray-100">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Editar Nivel</h3>
            <button @click="openEditModal = false" class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
        </div>

        <form :action="`/niveles/${editId}`" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gestión</label>
                <select name="gestion_id" x-model="editGestionId" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @foreach ($gestiones as $gestion)
                        <option value="{{ $gestion->id_gestion }}">{{ $gestion->gestion }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nivel</label>
                <input type="text" name="nivel" x-model="editNivel" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Turno</label>
                <input type="text" name="turno" x-model="editTurno" required
                    class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" @click="openEditModal = false"
                    class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-md shadow-blue-500/20">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
