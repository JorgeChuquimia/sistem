<div x-show="openDeleteModal" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 w-full h-full flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4"
    style="display: none; top:-24px;">
    <div @click.away="openDeleteModal = false"
        class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 border border-gray-100">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Confirmar Eliminación</h3>
            <button @click="openDeleteModal = false"
                class="text-gray-400 hover:text-gray-600 font-bold">&times;</button>
        </div>

        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
            <p class="font-semibold">¿Estás seguro de eliminar a esta persona?</p>
            <p class="mt-1">La persona <span class="font-bold underline" x-text="deleteNombre"></span> será eliminada
                de forma permanente.</p>
        </div>

        <form :action="`/personas/${deleteId}`" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" @click="openDeleteModal = false"
                    class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold shadow-md shadow-red-500/20">
                    Sí, Eliminar
                </button>
            </div>
        </form>
    </div>
</div>
