<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informes') }}
        </h2>
    </x-slot>
    <div class="text-center text-3xl my-2 font-extrabold text-green-600">
        <h1>INFORMES DE ACTIVIDADES</h1>
    </div>

    {{-- @livewire('reports.index') --}}

    @livewire('report.index')

</x-app-layout>
