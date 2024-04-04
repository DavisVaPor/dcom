<div>
    <div class="flex my-3 justify-between items-center border-b border-gray-300 border-3">
        <h1 class="mr-5 text-xl font-bold text-blue-500">ESTACIONES</h1>

        @if ($commission->estado == 'PENDIENTE')
            <div class="justify-end mr-4 my-2">
                <x-button wire:click="addStationCommission">
                    Añadir <x-icons.plus-circle class="ml-1"/>
                </x-button>
                
            </div>
        @endif
    </div>

    <div class="justify-content-between">
        <table class="rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
            <tr class="text-left border-b-2 border-gray-300">
                <th class="px-4 py-3 text-center">Localidad</th>
                <th class="px-4 py-3 text-center">Provincia</th>
                <th class="px-4 py-3 text-center">Distrito</th>
                <th class="px-4 py-3 text-center">Tipo</th>
                <th class="px-4 py-3 text-center">Estado</th>
                <th class="px-4 py-3"></th>
            </tr>
            @forelse ($commission->stations as $estation)
                <tr class="bg-gray-100 border-b border-gray-200">
                    <td class="px-4 py-3 text-center">{{ $estation->name }}</td>
                    <td class="px-4 py-3 text-center">{{ $estation->ubigeo->provincia }}</td>
                    <td class="px-4 py-3 text-center">{{ $estation->ubigeo->distrito }}</td>
                    <td class="px-4 py-3 text-center">{{ $estation->sistema }}:{{ $estation->tipo }}</td>
                    <td class="px-4 py-3">
                        @if ($estation->estado == 'OPERATIVO')
                            <div
                                class="text-gray-100 text-sm text-center bg-green-600 bg-clip-content font-semibold w-auto rounded-xl">
                                OPERATIVO
                            </div>
                        @else
                            <div
                                class="text-gray-100 text-sm text-center bg-red-600 bg-clip-content font-semibold w-auto rounded-xl">
                                INOPERATIVO
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if ($commission->estado == 'PENDIENTE')
                            <div class="text-center">
                                <button wire:click="mostrarDel({{ $estation->id }})"
                                    class="text-red-500 hover:text-gray-600 cursor-pointer">
                                    <x-icons.trash />
                                </button>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr class="bg-gray-100 border-b border-gray-200">
                    <td colspan="6" class="text-center">
                        No se encontraron registros
                    </td>
                </tr>
            @endforelse
        </table>
        
    </div>
    <span class="text-xs text-left">
        Registros Seleccionados : {{$commission->stations->count()}}
    </span>


    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Añadir Estacion</h1>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label class="text-base font-bold border-gray-200" for="name"
                    value="{{ __('Busqueda de Estacion') }}" />
                <div class="flex my-2">
                    <input wire:model='searchEstation' class="form-control m-auto rounded-xl w-full" type="search"
                        placeholder="Búsqueda" aria-label="Search">
                    <select wire:model='ubigeo' class="rounded-xl ml-2" name="" id="">
                        <option value="">Todas las Provincia</option>
                        <option value="101">Chachapoyas</option>
                        <option value="102">Bagua</option>
                        <option value="103">Bongara</option>
                        <option value="104">Condorcanqui</option>
                        <option value="105">Luya</option>
                        <option value="106">Rodriguez de Mendoza</option>
                        <option value="107">Utcubamba</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <div class="flex-grow overflow-auto">
                        <table class="rounded-t-lg my-2 w-full mx-auto bg-gray-200 text-gray-800">
                            <tr class="text-left border-b-2 border-gray-300">
                                <th class="font-bold px-2 py-1"></th>
                                <th class="font-bold px-2 py-1 ">Estacion</th>
                                <th class="font-bold px-2 py-1 text-center">Provincia</th>
                                <th class="font-bold px-2 py-1 text-center">Distrito</th>
                                <th class="font-bold px-2 py-1 text-center">Sistema:Tipo</th>
                            </tr>
                            @foreach ($estations as $estation)
                                @if (!$commission->stations->contains($estation->id))
                                    <tr class="bg-gray-100 border-b border-gray-200 text-sm hover:bg-blue-400">
                                        <td class="px-1">
                                            <input class="rounded-2xl" wire:model='selectedEstation'
                                                value="{{ $estation->id }}" type="radio">
                                        </td>
                                        <td class="px-2 py-1">{{ $estation->name }}</td>
                                        <td class="px-2 py-1">{{ $estation->ubigeo->provincia }}</td>
                                        <td class="px-2 py-1">{{ $estation->ubigeo->distrito }}</td>
                                        <td class="px-2 py-1 text-center">
                                            {{ $estation->sistema }}:{{ $estation->tipo }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $estations->links() }}
                        <p class="text-right text-xs">Numero de Registros {{ $estations->count() }}</p>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="addStation()" wire:loading.attr="disabled">
                {{ __('Añadir') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold">{{ __('') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea quitar Estacion?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="delEstacion({{ $modalDel }})" wire:loading.attr="disabled">
                {{ __('Si') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
