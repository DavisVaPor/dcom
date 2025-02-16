<div>
    <h1 class="mr-5 text-lg font-bold text-blue-800 text-center">MOVIMIENTOS DE LOS EQUIPOS DE
        TELECOMUNICACION</h1>

    <table class="text-sm text-center rounded-t-lg m-5 w-full mx-auto bg-gray-200 text-gray-800">
        <tr class="text-base border-b-2 border-gray-300">
            <th class="px-2 py-3">Cod</th>
            <th class="px-2 py-3">Equipo</th>
            <th class="px-2 py-3">Tipo</th>
            <th class="px-2 py-3 w-24">Fecha</th>
            <th class="px-2 py-3">Estacion Actual </th>
            <th class="px-2 py-3"></th>
            <th class="px-2 py-3">Estacion Anterior </th>
        </tr>

        @forelse ($movimients as $movimient)
            <tr class="bg-gray-100 border-b border-gray-200">
                <td class="py-2 font-bold text-left">{{ $movimient->good->codPatrimonio }}</td>
                <td class="py-2 font-bold text-left">{{ $movimient->good->denominacion }}</td>
                <td class="py-2 flex items-center">
                    @if ($movimient->tipo_movimiento === 'INSTALACION')
                        <div class="text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p>INSTALACIÓN</p>
                    @else
                        <div class="text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        {{ $movimient->tipo }}
                    @endif
                </td>
                <td class="py-2">{{ $movimient->fecha_movimiento }}</td>
                <td class="py-2">
                    @if ($movimient->estacion_out == null)
                        ALMACEN
                    @else
                        {{ $movimient->estacion_out->name }}
                    @endif
                </td>
                <td class="py-2 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                        <path fill-rule="evenodd"
                            d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </td>
                <td class="py-2"> {{$movimient->estation_in}} {{-- {{ $movimient->estation_in->name }} --}}</td>
                <td class="py-2 ">
                    <abbr title="Eliminar">
                        <button wire:click='deleteModal({{ $movimient->id }})'
                            class="inline-flex items-center text-gray-500 transition-colors duration-150 cursor-pointer hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="m-auto h-6 w-6" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </abbr>
                </td>
            </tr>
        @empty
            <tr class="bg-gray-100 border-b border-gray-200">
                <td colspan="7" class="text-center font-bold py-3 text-gray-400">No se encuentran registros</td>
            </tr>
        @endforelse
    </table>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalSup">
        <x-slot name="title">
            <h1 class="font-bold uppercase">{{ __('Eliminar Movimiento') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea eliminar?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalSup',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="deleteMovimient({{ $movement }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
