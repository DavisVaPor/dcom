<x-app-layout>
    <div class="flex justify-between items-center">
        <x-button wire:click="regresar" class="bg-gray-300">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-circle-left"
                class="svg-inline--fa fa-chevron-circle-left fa-w-16 w-4 h-3" role="img"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor"
                    d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z">
                </path>
            </svg>
            <p class="text-xs ml-2 my-auto">Regresar</p>
        </x-button>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comisiones') }}
        </h2>
    </x-slot>
    <div class="text-center text-3xl my-2 font-extrabold text-green-600">
        <h1>COMISIONES DE SERVICIOS</h1>
    </div>
    
    <p>
        
    </p>
    <div class="items-center text-base mt-2 w-full">
        <h3>DCOM: {{ $commission->numero }} - {{ $commission->year }}: 
            <span class="font-extrabold text-lg text-gray-800">"{{ $commission->comision }}"</span>
        </h3>
    </div>
    <div class="flex justify-between mt-4 border-b-2 border-gray-400">
        <div class="text-sm">
            <p>TIPO DE SERVICIO:
                <span class="font-bold">
                    @if ($commission->tipo === 'MANTENIMIENTO')
                        MANTENIEMIENTO DE LOS SISTEMAS DE TELECOMUNICACIÓN
                    @endif
                    @if ($commission->tipo === 'MEDICION')
                        MEDICION LOS SERVICIOS DE TELECOMUNICACIONES
                    @endif
                    @if ($commission->tipo === 'MEDICION')
                        PROMOCION DE LAS TELECOMUNIACIONES
                    @endif
                </span>
            </p>
        </div>

        <div class="mx-2">
            <p class="text-sm text-right font-bold">Inicio: {{ $commission->fecha_inicio }}</p>
        </div>
        <div class="mx-2">
            <p class="text-sm text-right font-bold">Fin: {{ $commission->fecha_fin }}</p>
        </div>
        <div class="mx-4">
            <p class="text-sm text-right font-bold">Estado: {{ $commission->estado }}</p>
        </div>
    </div>

    @livewire('commission.objectives', ['commission' => $commission], key($commission->id))
</x-app-layout>
