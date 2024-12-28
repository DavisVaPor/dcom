<div>
    <h1 class="mr-5 text-lg font-bold text-blue-800 text-center">REGISTRO DE ACTIVIDADES REALIZADAS</h1>
    <div class="flex justify-between items-center">
        <x-button wire:click="addModal" class="bg-yellow-600 justify-end">
            SERVICIO
            <span class="w-4 h-4 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </x-button>
        {{-- @livewire('report.servicio.mantenimiento', ['estation' => $estation, 'informe' => $informe], key($estation->id)) --}}
        <div class="flex justify-end items-center">
            @if ($informe->estado == 'BORRADOR')
                @isset($informe->mantenimient)
                    <x-button wire:click="addModal" class="bg-blue-500 justify-end">
                        Añadir
                        <span class="w-4 h-4 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </x-button>
                @endisset
            @endif
        </div>
    </div>

    @isset($informe->mantenimient)
        <table class="rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
            <tr class="text-left border-b-2 border-gray-300">
                <th class="px-2 py-2 w-10/12 ml-2" colspan="2">REGISTRO DE ACTIVIDADES REALIZADAS</th>
                @if ($informe->estado == 'BORRADOR')
                    <th class="px-1 py-2 w-1/12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                            </path>
                        </svg>
                    </th>
                @endif
            </tr>

            @forelse ($informe->activities as $activity)
                <tr class="bg-gray-100 border-b border-gray-200">
                    <td class="px-2 font-bold text-xs text-center w-4">{{ $loop->iteration }}</td>
                    <td class="px-2 py-2 w-10/12 text-sm">{{ $activity->descripcion }}</td>
                    @if ($informe->estado == 'BORRADOR')
                        <td class="px-4 py-1 w-1/12">
                            <div class="flex justify-between">
                                @livewire('report.activities.images', ['estation' => $estation, 'activity' => $activity, 'informe' => $informe], key($activity->id))
                                <button wire:click="editActivity({{ $activity->id }})"
                                    class="text-blue-500 hover:text-gray-900 cursor-pointer mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="text-red-500 hover:text-gray-900 cursor-pointer"
                                    wire:click="mostrarDel({{ $activity->id }})" wire:loading.attr="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    @endif
                </tr>
            @empty
                <tr class="bg-gray-100 border-b border-gray-200">
                    <td colspan="5" class="text-center my-2">.... Sin Registro Añadido....</td>
                </tr>
            @endforelse
        </table>
    @else
        SIN REGISTRO
    @endisset

    {{-- Modal de Registro de Actividad --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Tipo de Servicio</h1>
        </x-slot>

        <x-slot name="content">
            <div class="mb-2 flex justify-between">
                <h1 class="font-bold uppercase">Estacion:{{ $estation->name }}</h1>
                @if ($informe->estado == 'BORRADOR')
                    <select class="rounded-xl text-sm" wire:model='Servicio'>
                        <option value="DIAGNOSTICO">DIAGNOSTICO</option>
                        <option value="PREVENTIVO">PREVENTIVO</option>
                        <option value="CORRECTIVO">CORRECTIVO</option>
                    </select>
                @endif
                {{-- @isset($informe->servicemantenimiento)
                    <h1 class="font-bold uppercase">Tipo de Servicio:
                        <span class="ml-1 text-green-800">
                            @if ($informe->servicemantenimiento->tipo == 'DIAGNOSTICO')
                                {{ $informe->mantenimient->tipo }}
                            @endif
                            @if ($informe->servicemantenimiento->tipo == 'PREVENTIVO')
                                MANTENIMIENTO PREVENTIVO
                            @endif
                            @if ($informe->servicemantenimiento->tipo == 'CORRECTIVO')
                                MANTENIMIENTO CORRECTIVO
                            @endif
                        </span>
                    </h1>
                @endisset --}}
            </div>
            <div class="block">
                <x-label class="text-base font-bold border-gray-200" for="name"
                    value="{{ __('Fecha de Servicio') }}" />
                <input class="rounded-xl text-sm" type="date" name="" id=""
                    wire:model='fechaMantenimiento'>
                <x-input-error for="fechaMantenimiento" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="saveActivity()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold uppercase">{{ __('Eliminar actividad') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea eliminar?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="deleteActivity({{ $modalDel }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
