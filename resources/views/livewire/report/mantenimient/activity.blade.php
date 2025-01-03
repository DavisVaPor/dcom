<div>
    <div class="flex justify-end items-center">
        <x-button wire:click="addModal" class="bg-yellow-600 justify-end">
            SERVICIO REALIZADO
            <span class="w-4 h-4 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </x-button>
    </div>
    <h1 class="mr-5 text-lg font-bold text-blue-800 text-center">SERVICIO REALIZADO</h1>
    <table class="rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
        <tr class="text-left border-b-2 border-gray-300">
            <th>Tipo Servicio</th>
            <th>Diagnostico</th>
            <th>Acciones</th>
            <th>Fecha</th>
            <th>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                    </path>
                </svg>
            </th>
        </tr>
        @if ($servicemantenimiento)
            <tr class="bg-gray-100 border-b border-gray-200">
                <td><span>{{ $servicemantenimiento->servicio }}</span></td>
                <td><span>{{ $servicemantenimiento->diagnostico }}</span></td>
                <td><span>{{ $servicemantenimiento->acciones }}</span></td>
                <td><span>{{ $servicemantenimiento->fechaServicio }}</span></td>
                <td>
                    <button class="text-red-500 hover:text-gray-900 cursor-pointer"
                        wire:click="mostrarDel({{ $servicemantenimiento->id }})" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </td>
            @else
            <tr class="bg-gray-100 border-b border-gray-200">
                <td colspan="5" class="text-center my-2">.... Sin Registro Añadido....</td>
            </tr>
        @endif

    </table>

    <div class="mt-5">
        <h1 class="mr-5 text-lg font-bold text-blue-800 text-center">REGISTRO DE ACTIVIDADES REALIZADAS</h1>
        <div class="flex justify-end items-center">
            <x-button wire:click="addModalActivity" class="bg-yellow-800 justify-end">
                Añadir Actividad
                <span class="w-4 h-4 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </x-button>
        </div>
        <table class="rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
            <tr class="text-left border-b-2 border-gray-300">
                <th class="px-2 py-2 w-10/12 ml-2" colspan="2">ACTIVIDADES REALIZADAS EN LA ESTACION</th>
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

            @isset($servicemantenimiento)
                @forelse ($servicemantenimiento->activities as $activity)
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td class="px-2 font-bold text-xs text-center w-4">{{ $loop->iteration }}</td>
                        <td class="px-2 py-2 w-10/12 text-sm">{{ $activity->description }}</td>
                        @if ($informe->estado == 'BORRADOR')
                            <td class="px-4 py-1 w-1/12">
                                <div class="flex justify-between">
                                    <button wire:click="editActivity({{ $activity->id }})"
                                        class="text-blue-500 hover:text-gray-900 cursor-pointer mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button class="text-red-500 hover:text-gray-900 cursor-pointer"
                                        wire:click="deleteActividad({{ $activity->id }})" wire:loading.attr="disabled">
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
            @endisset
        </table>
    </div>


    {{-- Modal de Registro de Tipo de Servicio --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Tipo de Servicio</h1>
        </x-slot>
        <x-slot name="content">
            <h1 class="font-bold text-lg uppercase">Estacion:{{ $estation->name }}</h1>

            <div class="mb-2 flex justify-between">
                <div class="block">
                    <x-label class="text-base font-bold border-gray-200" for="name" value="{{ __('Servicio') }}" />
                    @if ($informe->estado == 'BORRADOR')
                        <select class="rounded-xl text-sm" wire:model='mantenimiento'>
                            <option value="DIAGNOSTICO">DIAGNOSTICO</option>
                            <option value="PREVENTIVO">PREVENTIVO</option>
                            <option value="CORRECTIVO">CORRECTIVO</option>
                        </select>
                        {{-- {{$mantenimiento}} --}}
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
                    <x-input-error for="mantenimiento" class="mt-2" />
                </div>

                <div class="block">
                    <x-label class="text-base font-bold border-gray-200" for="fechaServicio"
                        value="{{ __('Fecha de Servicio') }}" />
                    <input class="rounded-xl text-sm" type="date" name="" id=""
                        wire:model='mantenimient.fechaServicio'>
                    <x-input-error for="mantenimient.fechaServicio" class="mt-2" />
                </div>

            </div>

            <div class="block">
                <x-label class="text-base font-bold border-gray-200" for="mantenimient.diagnostico"
                    value="{{ __('Diagnostico de  la Estacion') }}" />
                <textarea id="name" wire:model.defer='mantenimient.diagnostico'
                    class="resize-none w-full h-2/5 border rounded-md">

                    </textarea>
                <x-input-error for="mantenimient.diagnostico" class="mt-2" />
            </div>
            <div class="block">
                <x-label class="text-base font-bold border-gray-200" for="mantenimient.acciones"
                    value="{{ __('Acciones de  la Estacion') }}" />
                <textarea id="name" wire:model.defer='mantenimient.acciones' class="resize-none w-full h-2/5 border rounded-md">

                    </textarea>
                <x-input-error for="mantenimient.acciones" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="saveMantenimiento()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold uppercase">{{ __('Eliminar Servicio') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea eliminar?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="deleteMantenimiento({{ $modalDel }})"
                wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>


        {{-- Modal de Registro de Actividad --}}
        <x-dialog-modal wire:model="modalAddActivity">
            <x-slot name="title">
                <h1 class="font-bold uppercase">Agregar Actividad</h1>
            </x-slot>
            <x-slot name="content">
                <h1 class="font-bold text-lg uppercase">Estacion:{{ $estation->name }}</h1>
                
                <div class="mb-2 flex justify-between">
                    <div class="block w-full">
                        <x-label class="text-base font-bold border-gray-200" for="description" value="{{ __('Actividad Realizada') }}" />
                       
                        <textarea id="name" wire:model='description' class="resize-none w-full h-3/5 border rounded-md">
                            
                        </textarea>
                    </div>
                </div>
            </x-slot>
    
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('modalAddActivity',false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
    
                <x-button class="ml-2" wire:click="saveActividad()" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
</div>
