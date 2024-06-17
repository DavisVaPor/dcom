<div>
    <div class="flex my-3">
        <input wire:model='search' class="form-control rounded-xl mr-sm-2 w-full" type="search"
            placeholder="Búsqueda de registros" aria-label="Search">

        <select class="rounded-xl ml-3" name="tipo" id="tipo" wire:model='estado'>
            <option seleted value="">Todos los Estados</option>
            <option value="BORRADOR">Borrador</option>
            <option value="PRESENTADO">Presentado</option>
            <option value="REVISADO">Revisado</option>
        </select>

        <select class="rounded-xl ml-3" name="tipo" id="tipo" wire:model='tipo'>
            <option seleted value="">Tipo</option>
            <option value="MANTENIMIENTO">MANTENIMIENTO</option>
            <option value="SUPERVISION">SUPERVISION</option>
            <option value="PROMOCION">Promocion</option>
        </select>

        <x-button wire:click="addReport" class="bg-green-500 ml-5">
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
    <table class="bg-table-auto rounded-t-lg h-full w-full mx-auto bg-gray-700">
        <tr class="border-b-2 border-gray-300 text-center text-white">
            <th class="px-2 py-3">N°</th>
            <th class="w-3/12 px-4 py-3">Asunto</th>
            <th class="px-4 py-3">Comision</th>
            <th class="px-4 py-3 w-28">Fecha</th>
            <th class="py-3">Estado</th>
            <th class="px-4 py-3">Tipo</th>
            <th class="px-2 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                    </path>
                </svg>
            </th>
        </tr>
        <tbody>
            @if ($reports->isNotEmpty())
                @foreach ($reports as $report)
                    <tr class="bg-gray-100 border-b border-gray-300 py-1 hover:bg-green-100">
                        <td class="text-xs px-2 text-center uppercase">
                            {{ $loop->iteration }}
                        </td>
                        <td class="w-4/12 text-sm px-2 text-left uppercase">
                            <a href="{{ route('informe', [$report]) }}" class="font-semibold hover:text-blue-600">
                                {{ $report->id }} - {{ $report->asunto }}
                            </a>
                        </td>
                        <td class="text-sm text-gray-600 text-center">
                            <abbr title="{{ $report->commission->name }}">
                                <a href="{{ route('commision.show', [$report->commission]) }}">
                                    C-{{ $report->commission->id }}
                                </a>
                            </abbr>
                        </td>
                        <td class="text-xs text-center w-28 text-gray-400">{{ $report->fechaCreacion }}</td>
                        <td class="">
                            @if ($report->estado == 'BORRADOR')
                                <div
                                    class="text-gray-100 text-xs text-center m-auto bg-yellow-600 bg-clip-content font-semibold w-24 rounded-xl">
                                    {{ $report->estado }}
                                </div>
                            @else
                                @if ($report->estado == 'PRESENTADO')
                                    <div
                                        class="text-gray-100 text-xs text-center m-auto bg-blue-500 bg-clip-content font-semibold w-24 rounded-xl">
                                        {{ $report->estado }}
                                    </div>
                                @endif
                                @if ($report->estado == 'REVISADO')
                                    <div
                                        class="text-gray-100 text-xs text-center m-auto bg-green-500 bg-clip-content font-semibold w-24 rounded-xl">
                                        {{ $report->estado }}
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td>
                            <p class="text-xs text-center">
                                {{ $report->commission->tipo }}
                            </p>
                        </td>
                        <td class="px-2 text-right">
                            <div class="flex justify-center">
                                @if ($report->estado == 'BORRADOR')
                                    <button wire:click="editReport({{ $report->id }})"
                                        class="text-blue-500 hover:text-gray-900 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button wire:click="delReport({{ $report->id }})"
                                        class="text-red-500 hover:text-gray-900 cursor-pointer ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                @endif
                                @if ($report->estado == 'PRESENTADO')
                                    <a href="{{ route('informepdf', [$report]) }}"
                                        class="text-gray-500 hover:text-gray-900 cursor-pointer">
                                        <svg class="w-6 h-6 m-auto" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                d="M448 192V77.25c0-8.49-3.37-16.62-9.37-22.63L393.37 9.37c-6-6-14.14-9.37-22.63-9.37H96C78.33 0 64 14.33 64 32v160c-35.35 0-64 28.65-64 64v112c0 8.84 7.16 16 16 16h48v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h48c8.84 0 16-7.16 16-16V256c0-35.35-28.65-64-64-64zm-64 256H128v-96h256v96zm0-224H128V64h192v48c0 8.84 7.16 16 16 16h48v96zm48 72c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z">
                                            </path>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="bg-white border-b border-gray-300 py-1">
                    <td colspan="7" class="text-center font-bold">No se encuentra registros</td>
                </tr>
            @endif
        </tbody>
    </table>
    <p class="text-right font-bold mt-2 text-gray-500">
        Total: {{ $reports->count() }} Registros
    </p>

    {{-- {{ $reports->links() }} --}}

    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">

            <div class="flex justify-between items-center">
                <h1 class="font-bold uppercase underline">Registrar Informe</h1>
            </div>
            <div class="flex justify-end items-center"> 
                <label for="">Fecha:</label>
                <input disabled type="date" name="" value="{{ $fechactual }}" id=""
                    class="rounded-xl block font-bold text-center">
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="col-span-6 sm:col-span-4">
                <x-label class="text-base font-bold border-gray-200" for="name"
                    value="{{ __('ASUNTO DEL INFORME') }}" />
                <textarea disabled id="name" wire:model.defer='asunto'
                    class="text-sm resize-none w-full h-20 border rounded-md bg-gray-100">

                </textarea>
                <x-input-error for="asunto" class="mt-2" />
            </div>


            <div class="col-span-6 sm:col-span-4">
                <table
                    class="rounded-t-lg mx-2 text-gray-800 border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <tr class="text-left border-b-2 border-gray-300">
                        <th colspan="2" class="font-bold  py-1">COMISIONES CONFIRMADAS: </th>
                    </tr>
                    @foreach ($commissions as $item)
                        <tr class="bg-white border-b border-gray-200 text-sm">
                            <td class="px-2 py-1">
                                <input class="rounded-2xl" wire:model='selectedCommission'
                                    value="{{ $item->id }}" type="radio">
                            </td>
                            <td class="px-2">#{{ $item->id }}-{{ $item->comision }}:'('{{ $item->tipo }}')'
                            </td>
                        </tr>
                    @endforeach
                </table>
                <x-input-error for="selectedCommission" class="mt-2" />
            </div>
            @isset($fechafinComision)
                {{ $fechafinComision }}
            @endisset
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="saveReport()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold">{{ __('Eliminar Informe') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea eliminar?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="deleteReport({{ $modalDel }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
