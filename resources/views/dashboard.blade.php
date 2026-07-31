<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Principal') }}
    </x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Estudiantes</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">1,245</h4>
                    <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">+4% este mes</span>
                </div>
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl shadow-sm">
                    👨‍🎓
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Docentes</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">84</h4>
                    <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">Activos</span>
                </div>
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl shadow-sm">
                    👩‍🏫
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Materias</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">18</h4>
                    <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">Plan de estudios</span>
                </div>
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-xl shadow-sm">
                    📚
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Gestión Actual</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">2026</h4>
                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">En curso</span>
                </div>
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-sm">
                    📅
                </div>
            </div>

        </div>

        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
            <div class="max-w-3xl">
                <h3 class="text-xl font-bold text-gray-900 mb-2">¡Bienvenido al Panel de Administración Escolar!</h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    Desde este panel centralizado puedes administrar de manera eficiente la estructura académica, supervisar los registros de usuarios, gestionar roles y controlar el flujo de información de tu institución educativa de forma segura.
                </p>
                <a href="{{ route('roles.index') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md shadow-blue-500/20 transition">
                    Ver Módulo de Roles &rarr;
                </a>
            </div>
        </div>
    </div>
</x-app-layout>