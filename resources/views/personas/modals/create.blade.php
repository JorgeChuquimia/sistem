<div x-show="openCreateModal" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 w-full h-full flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4"
    style="display: none; top:-24px;">
    <div @click.away="openCreateModal = false"
        class="bg-white rounded-2xl shadow-xl max-w-xl w-full p-6 border border-gray-100 overflow-y-auto max-h-[90vh]">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Registrar Nueva Persona</h3>
            <button @click="openCreateModal = false"
                class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
        </div>

        <form action="{{ route('personas.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Usuario del Sistema</label>
                    <select name="usuario_id" required
                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Seleccione un usuario...</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id_usuario }}">{{ $usuario->email }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CI</label>
                    <input type="text" name="ci" required placeholder="Número de carnet"
                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombres</label>
                    <input type="text" name="nombres" required placeholder="Nombres"
                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
                    <input type="text" name="apellidos" required placeholder="Apellidos"
                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" required
                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Profesión</label>
                    <input type="text" name="profesion" required placeholder="Profesión"
                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Celular</label>
                    <input type="text" name="celular" required placeholder="Celular"
                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                    <input type="text" name="direccion" required placeholder="Dirección"
                        class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>
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
