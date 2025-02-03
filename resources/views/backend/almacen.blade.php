<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventario del Almacen de la DRTC') }}
        </h2>
    </x-slot>
    <div class="text-center text-3xl my-2 font-bold text-green-600">
        <h1>Inventario de Equipos del Almacen</h1>
    </div>

    @livewire('warehouse.index')

</x-app-layout>