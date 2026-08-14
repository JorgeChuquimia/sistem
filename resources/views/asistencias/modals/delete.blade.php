<div x-show="openDeleteModal" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 w-full h-full flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4"
    style="display: none; top:-24px;">
    <div @click.away="openDeleteModal = false"
        class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 border border-gray-100 space-y-4">

        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900">¿Eliminar registro?</h3>
            <button @click="openDeleteModal = false"
                class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
        </div>

        <p class="text-sm text-gray-600">Esta acción eliminará el registro de asistencia seleccionado del sistema de
            forma permanente.</p>

        <form :action="`{{ url('asistencias') }}/${deleteId}`" method="POST" class="flex justify-end space-x-3 pt-2">
            @csrf
            @method('DELETE')
            <button type="button" @click="openDeleteModal = false"
                class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium">
                Cancelar
            </button>
            <button type="submit"
                class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold shadow-md shadow-red-500/20">
                Sí, eliminar
            </button>
        </form>
    </div>
</div>
