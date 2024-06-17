<x-app-layout>
    <div class="flex justify-between items-center">
        <x-button wire:click="regresar" class="bg-gray-300">
            <a class="text-xs ml-2 my-auto" href="{{ route('commissions') }}">Regresar</a>
        </x-button>

        @livewire('commission.show', ['commission' => $commission])
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comisiones') }}
        </h2>
    </x-slot>
    <div class="text-center text-3xl my-2 font-extrabold text-green-600">
        <h1>COMISIONES DE SERVICIOS</h1>
    </div>

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
                    @if ($commission->tipo === 'SUPERVISION')
                        SUPERVISIÓN DE LOS SERVICIOS DE TELECOMUNICACIONES
                    @endif
                    @if ($commission->tipo === 'PROMOCION')
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
    @livewire('commission.users', ['commission' => $commission], key($commission->id))

    @if ($commission->tipo == 'MANTENIMIENTO')
        @livewire('commission.stations', ['commission' => $commission], key($commission->id))
    @else
        @livewire('commission.ubigees', ['commission' => $commission], key($commission->id))
    @endif

    @livewire('commission.goods', ['commission' => $commission], key($commission->id))

</x-app-layout>
