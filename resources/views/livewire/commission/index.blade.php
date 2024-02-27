<div>
    <div class="flex">
        <input wire:model='search' class="form-control rounded-xl w-full mr-2" type="search" placeholder="Búsqueda"
            aria-label="Search">
        <x-button wire:click="addCommission" class="bg-green-500 ml-3 hover:bg-green-800">
            Crear
            <span class="w-6 h-6 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </x-button>
    </div>

    <div class="flex my-2 items-center justify-end ">
        <input wire:model='searchcode' class="form-control rounded-xl w-full mr-2 py-2 bg-white" type="search"
            placeholder="Numero" aria-label="searchcode">
        <label for="">Servicio:</label>
        <select class="text-sm rounded-xl mx-2" name="tipofiltro" id="tipofiltro" wire:model='tipofiltro'>
            <option seleted value="">Todos</option>
            <option value="MANTENIMIENTO">MANTENIMIENTO</option>
            <option value="MEDICION">MEDICION</option>
            <option value="PROMOCION">PROMOCION</option>
        </select>
        <label for="">Estado:</label>
        <select class="text-sm rounded-xl mx-2" name="estado" id="estado" wire:model='estado'>
            <option seleted value="">Todos</option>
            <option value="PENDIENTE">Pediente</option>
            <option value="CONFIRMADO">Confirmado</option>
        </select>

        <label for="">Mes:</label>
        <select class="text-sm rounded-xl mx-2" name="" id="mes" wire:model='mes'>
            <option seleted value="">Todos</option>
            @foreach ($meses as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>

        <label for="">Año:</label>
        <select class="text-sm rounded-xl mx-2" name="" id="mes" wire:model='anho'>
            <option seleted value="">Todos</option>
            <option value="2024">2024</option>
        </select>
    </div>

    <table class="bg-table-auto rounded-t-lg h-full w-full mx-auto bg-gray-500 text-gray-800">
        <tr class="border-b-2 border-gray-300 text-center text-white">
            <th class="px-1">Cod</th>
            <th class="w-1/3 px-4 py-3">Asunto</th>
            <th class="py-3 w-24">Inicio</th>
            <th class="py-3 w-24">Dias</th>
            <th class="py-3 w-32">Tipo</th>
            <th class="py-3 w-32">Estado</th>
            <th class="py-3">
                <abbr title="Operaciones">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                        </path>
                    </svg>
                </abbr>
            </th>
        </tr>
        @forelse ($commissions as $commission)
            <tr class="bg-gray-100 border-b border-gray-400 py-1 hover:bg-green-100">
                <td class="py-1 text-xs text-center">C{{ $commission->numero }}</td>
                <td class="py-1 w-2/4 lg:text-xs xl:text-sm text-sm px-2 text-left uppercase">
                    <a href="{{ route('commision.show', [$commission]) }}" class="font-semibold hover:text-blue-600">
                        {{ $commission->comision }}
                    </a>
                </td>
                <td class="py-1 text-xs text-center w-auto text-blue-600">{{ $commission->fecha_inicio }}</td>
                <td class="py-1 text-sm text-center w-24 text-blue-600">{{ $commission->periodo }}</td>
                <td class="py-1 m-auto w-32 text-xs text-center font-semibold">
                    {{$commission->tipo}}
                </td>
                <td class="py-1 m-auto w-auto">
                    @if ($commission->estado == 'PENDIENTE')
                        <div
                            class="text-gray-100 text-sm text-center bg-yellow-600 bg-clip-content font-semibold w-auto rounded-xl">
                            P
                        </div>
                    @endif
                    @if ($commission->estado == 'CONFIRMADO')
                        <div
                            class="text-gray-100 text-sm text-center bg-blue-500 bg-clip-content font-semibold w-auto rounded-xl">
                            C
                        </div>
                    @endif
                </td>
                <td class="py-1 px-2 text-right">
                    <div class="flex justify-center">
                        @if ($commission->estado == 'PENDIENTE')
                            <button wire:click="editCommission({{ $commission->id }})"
                                class="text-blue-500 hover:text-gray-900 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button wire:click="delCommission({{ $commission->id }})"
                                class="text-red-500 hover:text-gray-900 cursor-pointer ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        @endif
                        @if ($commission->estado == 'CONFIRMADO')
                            <a href="{{ route('commisionpdf', [$commission]) }}"
                                class="text-gray-500 hover:text-gray-900 cursor-pointer">
                                <svg class="w-6 h-6 m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M448 192V77.25c0-8.49-3.37-16.62-9.37-22.63L393.37 9.37c-6-6-14.14-9.37-22.63-9.37H96C78.33 0 64 14.33 64 32v160c-35.35 0-64 28.65-64 64v112c0 8.84 7.16 16 16 16h48v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h48c8.84 0 16-7.16 16-16V256c0-35.35-28.65-64-64-64zm-64 256H128v-96h256v96zm0-224H128V64h192v48c0 8.84 7.16 16 16 16h48v96zm48 72c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z">
                                    </path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr class="border-b border-gray-100 bg-gray-100 py-1">
                <td colspan="7" class="bg-gray-100 border-b border-gray-400 text-center py-2 grid-row-4 italic">
                    ... No se encuentraron datos ...
                </td>
            </tr>
        @endforelse
    </table>
    <p class="text-end mt-1">
        Total de Registros: {{ $commissions->count() }}
    </p>
    <p class="py-2">{{ $commissions->links() }}</p>


    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold text-gray-500 uppercase">Registro de la Comision de Servicio</h1>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 my-2 flex items-center ">
                <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="tipo"
                    value="{{ __('Tipo de Servicio') }}" />
                <select class="rounded-xl text-sm" name="tipo" id="tipo" wire:model='tipo'>
                    <option value="">Seleccione</option>
                    <option value="MANTENIMIENTO">MANTENIMIENTO DEL SISTEMA DE COMUNICACION</option>
                    <option value="MEDICION">MEDICION DE LOS SERVICIOS DE TELECOMUNICACIONES</option>
                    <option value="PROMOCION">PROMOCION DE LAS TELECOMUNICACIONES</option>
                </select>
            </div>
            <x-input-error for="tipo" class="mt-2" />
            <div class="col-span-6 sm:col-span-4">
                <x-label class="text-sm font-bold border-gray-200 uppercase" for="name"
                    value="{{ __('Asunto') }}" />
                <textarea wire:model.defer='nameCommision' name="nameCommision" rows="5"
                    class="resize-none w-full border rounded-md border-gray-300" id="">
                
                </textarea>
                <x-input-error for="nameCommision" class="mt-2" />
            </div>


            <div class="flex justif items-center mt-2">
                <x-label class="text-sm font-bold border-gray-200 uppercase mr-2 " for="fecha"
                    value="{{ __('Fecha de la Comisión DEL') }}" />
                <x-input id="fechainicio" type="date" class=" block font-semibold" wire:model='fechainicio'
                    min="{{ $fechaActual }}" />

                <x-label class="text-sm font-bold mx-2 border-gray-200 uppercase " for="fecha"
                    value="{{ __('AL') }}" />
                <x-input id="fechafin" type="date" class=" block font-semibold" wire:model='fechafin'
                    min="{{ $fechaActual }}" />

            </div>
            <x-input-error for="fechainicio" class="mt-2" />
            <x-input-error for="fechafin" class="mt-2" />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="saveCommission()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold uppercase">{{ __('Eliminar Registro') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea eliminar?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="deleteCommission({{ $modalDel }})"
                wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    
</div>
