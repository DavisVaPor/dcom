<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comisiones') }}
        </h2>
    </x-slot>
    <div class="text-center text-3xl mb-2 font-extrabold text-green-600">
        <h1>COMISIONES DE SERVICIOS</h1>
    </div>

    @livewire('commission.index')

</x-app-layout>
