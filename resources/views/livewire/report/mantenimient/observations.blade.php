<div>
    <h1 class="mr-5 text-lg font-bold text-blue-800 text-center">REGISTRO DE OBSERVACIONES</h1>
    <div class="flex justify-end my-2 items-center">
        @if ($informe->estado == 'BORRADOR')
            <x-button wire:click="addModal" class="bg-blue-500 justify-end">
                Añadir
                <span class="w-6 h-6 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </x-button>
        @endif
    </div>
    <table class="rounded-t-lg m-5 w-full mx-auto bg-gray-200 text-gray-800">
        <thead>
            <tr class="text-left border-b-2 border-gray-300">
                <th class="px-4 py-3 w-1/12 text-center">#</th>
                <th class="px-4 py-3 w-8/12">Descripcion</th>
                <th class="px-4 py-3  text-center">Prioridad</th>
                @if ($informe->estado == 'BORRADOR')
                    <th class="px-4 py-3">Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @isset($servicemantenimiento)
                @forelse ($servicemantenimiento->observations as $observation)
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td class="px-4 mb-auto font-bold text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $observation->description }}</td>
                        <td class="px-4 py-3">
                            @if ($observation->nivel == 'ALTA')
                                <div
                                    class="text-gray-100  text-sm text-center bg-red-500 bg-clip-content font-bold w-auto rounded-xl">
                                    {{ $observation->nivel }}
                                </div>
                            @else
                                @if ($observation->nivel == 'MODERADO')
                                    <div
                                        class="text-gray-700  text-sm text-center bg-yellow-500 bg-clip-content font-bold w-auto rounded-xl">
                                        <p class="m-2"> {{ $observation->nivel }}</p>

                                    </div>
                                @else
                                    @if ($observation->nivel == 'BAJA')
                                        <div
                                            class="text-gray-100  text-sm text-center bg-green-500 bg-clip-content font-bold w-auto rounded-xl">
                                            {{ $observation->nivel }}
                                        </div>
                                    @else
                                        <div
                                            class="text-gray-100  text-sm text-center bg-gray-500 bg-clip-content font-bold w-auto rounded-xl">
                                            {{ $observation->nivel }}
                                        </div>
                                    @endif
                                @endif
                            @endif
                        </td>
                        @if ($informe->estado == 'BORRADOR')
                            <td class="px-4 py-3">
                                <div class="flex justify-between">
                                    <button wire:click="editObservation({{ $observation->id }})"
                                        class="text-blue-500 hover:text-blue-900 cursor-pointer mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 m-auto" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button class="text-red-500 hover:text-red-900 cursor-pointer"
                                        wire:click="mostrarDel({{ $observation->id }})" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 m-auto" fill="none"
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
                        <td colspan="4" class="text-center my-2">.... Sin Registro Añadido....</td>
                    </tr>
                @endforelse
            @endisset
        </tbody>
    </table>

    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Añadir Observación</h1>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 bg-gray-50 p-2 border rounded-xl">
                <div class="flex">
                    <x-label class="text-base font-bold mr-2 border-gray-200 mt-2" for="tipo"
                        value="{{ __('Nivel de Prioridad') }}" />
                    <select class="rounded-xl" name="tipo" id="tipo" wire:model.defer='observation.nivel'>
                        <option>NIVEL DE PRIORIDAD ...</option>
                        <option value="ALTA">ALTA</option>
                        <option value="MODERADO">MODERADO</option>
                        <option value="BAJA">BAJA</option>
                        <option value="NINGUNA">NINGUNA</option>
                    </select>
                    <x-input-error for="observation.atencion" class="mt-2" />
                </div>

                <x-label class="text-base font-bold border-gray-200" for="name" value="{{ __('DESCRIPCION') }}" />
                <textarea id="name" wire:model.defer='observation.description' class="resize-none w-full h-1/4 border rounded-md"></textarea>
                <x-input-error for="observation.description" class="mt-2" />

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="saveObservation()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold">{{ __('Eliminar observacion') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea eliminar?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="deleteObservation({{ $modalDel }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
