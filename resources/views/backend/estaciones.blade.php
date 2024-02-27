<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estaciones') }}
        </h2>
    </x-slot>
    <div class="text-center text-3xl my-2 font-extrabold text-green-600">
        <h1>ESTACIONES DE COMUNICACIONES</h1>
    </div>

    @livewire('station.index')

</x-app-layout>