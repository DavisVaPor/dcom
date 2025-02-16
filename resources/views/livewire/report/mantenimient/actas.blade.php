<div>
    <div class="flex mb-2">
        <h1 class="w-11/12 mr-5 text-lg font-bold text-green-800 text-center">ACTA DE MANTENIMIENTO</h1>
        @if ($informe->estado == 'BORRADOR')
            <div>
                <x-button wire:click="addModal" class="bg-green-500 text-right">
                    Añadir
                    <span class="w-6 h-6 ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </x-button>
            </div>
        @endif
    </div>

    <div>
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 w-ful text-center">Acta de Mantenimiento</th>
                    <th class="py-3 w-32 text-center">Fecha</th>
                    <th class="py-3 w-1/12 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($servicemantenimiento->actas as $item)
                    <tr class=" border-b border-gray-200 hover:bg-blue-100">
                        <td class="w-8/12 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="mr-2 text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                            clip-rule="evenodd"></path>
                                    </svg>

                                </div>
                                <span class="font-medium">{{ $item->acta }}</span>
                            </div>
                        </td>
                        <td class="py-3 w-32 text-xs text-center">
                            <span class="font-medium">{{ $item->fechaActa }}</span>
                        </td>

                        <td class="py-3 w-1/12 text-center">
                            <div class="flex item-center justify-center">
                                <abbr title="Previsualizcion del Documento">
                                    <button wire:click='infoActa({{ $item }})'
                                        class="w-6 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </abbr>

                                @if ($informe->estado == 'BORRADOR')
                                    <abbr title="Eliminar Registro">
                                        <div wire:click='deleteModal({{ $item->id }})'
                                            class="w-6 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </abbr>
                                @endif

                            </div>
                        </td>
                    @empty
                        <td class="py-3 w-full px-6 text-center whitespace-nowrap" colspan="3">
                            No Existen Datos
                        </td>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Añadir Acta --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold">Registro de Acta</h1>
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-between items-center">
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label class="text-base font-bold border-gray-200" for="url" value="{{ __('Archivo') }}" />
                    @isset($acta)
                        {{ $acta->name }}
                    @endisset
                    <label
                        class="inline-flex items-center py-2 px-2 bg-gray-300 text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <input type='file' class="" wire:model='file_url' accept="application/pdf">
                    </label>
                    <x-label class="text-sm text-center font-bold border-gray-200" for="url"
                        value="{{ __('.:: Archivo no debe pasarse de los 3 MB ::.') }}" />
                    <x-input-error for="file_url" class="mt-2" />
                </div>
                <div class="block ml-4">
                    <x-label class="text-base font-bold border-gray-200" for="name"
                        value="{{ __('Fecha de Acta') }}" />
                    <input class="rounded-xl text-sm" type="date" id="" wire:model='fechaActa'
                        min="2018-01-01" max="{{ $fechaActual }}">
                    <x-input-error for="fechaActa" class="mt-2" role="alert" />
                </div>
            </div>

            <div wire:loading wire:target="file_url" class="bg-yellow-300 border-l-4 border-red-300 p-4 m-auto"
                role="alert">
                <p class="font-bold text-center">Subiendo archivo ...</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="save()" wire:loading.attr="disabled">
                {{ __('Agregar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Visualizar Acta Cargada --}}
    @isset($visualizarActa)
        <x-dialog-modal wire:model="modalInfo">
            <x-slot name="title">
                <h1 class="uppercase">Acta de Manteniemiento</h1>
            </x-slot>

            <x-slot name="content">
                <h1 class="text-lg text-center font-extrabold">
                    ESTACIÓN DE {{ $visualizarActa }}
                </h1>
                <h3 class="text-sm text-right font-extrabold">
                    FECHA DE CREACION {{ $visualizarActa->created_at }}
                </h3>
                <iframe src="{{ Storage::url($visualizarActa->file_url) }}" width="100%" height="400px">
                </iframe>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('modalInfo',false)" wire:loading.attr="disabled">
                    {{ __('Cerrar') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endisset

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalEliminar">
        <x-slot name="title">
            <h1 class="font-bold uppercase">{{ __('Eliminar Registro') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea eliminar el registro?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalEliminar',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="deleteActa({{ $modalEliminar }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
