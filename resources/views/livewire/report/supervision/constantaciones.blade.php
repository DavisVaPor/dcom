<div>
    <div class="flex my-3 justify-between border-b border-gray-300 border-3">
        <h1 class="mr-5 text-lg font-bold text-gray-800">CONSTATACION DEL ESPECTRO RADIOELECTRICO</h1>
        @if ($report->estado == 'BORRADOR')
            <x-button wire:click="addModal" class="bg-green-500">
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

    <table class="rounded-t-lg my-2 w-full mx-auto bg-gray-200 text-gray-800">
        <tr class="text-left border-b-2 border-gray-300">
            <th class="px-2 py-3 text-center">Fecha</th>
            <th class="px-2 py-3 text-center">Servicio de Radiodifusión</th>
            <th class="px-2 py-3 text-center">Ubigeo</th>
            <th class="px-2 py-3 text-center">Ubicación</th>
            <th class="px-2 py-3 text-center">Caracteristicas</th>
            <th class="px-2 py-3 text-center">Observaciones</th>
            @if ($report->estado == 'BORRADOR')
                <th class="px-2 py-3 w-24">Acciones</th>
            @endif
        </tr>

        @forelse ($report->findings as $constatacion)
            <tr class="bg-gray-100 border-b border-gray-200">
                <td class="px-2 py-2 text-center">{{ $constatacion->fechaConstatacion }}</td>
                <td class="px-2 py-2 text-center">{{ $constatacion->Radiodifusion }}</td>
                <td class="px-2 py-2 text-center">{{ $constatacion->ubigeo->id }}</td>
                <td class="px-2 py-2 text-center">{{ $constatacion->ubicacion }}</td>
                <td class="px-2 py-2 text-center">{{ $constatacion->caracteristicas }}</td>
                <td class="px-2 py-2 text-center">{{ $constatacion->observaciones }}</td>
                @if ($report->estado == 'BORRADOR')
                    <td class="">
                        <div class="flex justify-center">
                            <button wire:click='openModalImage({{ $constatacion->id }})'
                                class="text-green-500 hover:text-gray-900 cursor-pointer mr-2">
                                <abbr title="VER IMAGEN">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="w-6 h-6 m-auto">
                                        <path fill="currentColor"
                                            d="M447.1 32h-384C28.64 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM111.1 96c26.51 0 48 21.49 48 48S138.5 192 111.1 192s-48-21.49-48-48S85.48 96 111.1 96zM446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z" />
                                    </svg>
                                </abbr>
                            </button>
                            <button wire:click="edit({{ $constatacion->id }})"
                                class="text-blue-500 hover:text-gray-900 cursor-pointer mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 m-auto" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>

                            <button class="text-red-500 hover:text-gray-900 cursor-pointer"
                                wire:click="mostrarDel({{ $constatacion->id }})" wire:loading.attr="disabled">
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
            <tr class="bg-gray-100 border-b border-gray-200 text-center">
                <td colspan="8" class="py-2"> ..::No hay registro::..</td>
            </tr>
        @endforelse
    </table>

    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Registro de Constatacion</h1>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 bg-gray-50 p-2 border rounded-xl">
                <div class="flex justify-between">
                    <div class="">
                        <x-label class="text-base mr-5 font-bold border-gray-200" for="name"
                            value="{{ __('UBICACIÓN') }}" />
                        <select class="rounded-xl text-sm" name="tipo" id="tipo" wire:model='ubigeo'>
                            <option value="" selected></option>
                            @foreach ($report->commission->ubigeo as $item)
                                <option value="{{ $item->id }}">{{ $item->provincia }}-{{ $item->distrito }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="ubigeo" class="mt-2" />
                    </div>

                    <div>
                        <x-label class="text-base font-bold border-gray-200" for="name"
                            value="{{ __('FECHA') }}" />
                        <input class="rounded-xl" type="date" max="{{ $fechaActual }}" name=""
                            id="" wire:model.defer='finding.fecha'>
                        <x-input-error for="finding.fecha" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-label class="text-base mr-5 font-bold border-gray-200" for="name"
                        value="{{ __('SERVICIO DE RADIODIFUSION') }}" />
                    <select class="rounded-xl text-sm" name="tipo" id="tipo" wire:model='finding.servicio'>
                        <option value="" selected></option>
                        <option value="TV"> TELEVISIVA</option>
                        <option value="FM"> FRECUENCIA MODULADA</option>
                    </select>
            </div>

            <x-label class="text-base font-bold border-gray-200 mt-2" for="name"
                value="{{ __('REFERENCIA DE LA TOMA DE MEDIDA') }}" />
            <textarea id="name" wire:model.defer='finding.ubicacion' class="resize-none w-full h-20 border rounded-md" placeholder="Ubicacion"></textarea>
            <x-input-error for="finding.ubicacion" class="mt-2" />

            <x-label class="text-base font-bold border-gray-200 mt-2" for="name"
                value="{{ __('CARACTERISTICAS') }}" />
            <textarea id="name" wire:model.defer='finding.caracteristicas' class="resize-none w-full h-20 border rounded-md" 
            placeholder="Estaciones Autorizadas, Se encuentran operativos, No se encuentran operativos ">
                </textarea>
            <x-input-error for="finding.caracteristicas" class="mt-2" />

            <x-label class="text-base font-bold border-gray-200 mt-2" for="name"
                value="{{ __('OBSERVACIONES') }}" />
            <textarea id="name" wire:model.defer='finding.observaciones' class="resize-none w-full h-20 border rounded-md" placeholder="Estaciones No Autorizadas ">
               
            </textarea>
            <x-input-error for="finding.observaciones" class="mt-2" />

            <div class="mt-2">
                <label
                    class="inline-flex items-center py-2 px-2 bg-blue-300 text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:text-white">
                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                    </svg>
                    <input type='file' class="" wire:model='imagen' accept="image/*">
                </label>
                <x-input-error for="imagen" class="mt-2" />
            </div>
            <div wire:loading wire:target="imagen" class="bg-yellow-300 border-l-4 border-red-300 p-4 m-auto"
                role="alert">
                <p class="font-bold text-center">Previsualizacion</p>
                <p>Cargando la imagen ...</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="save()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>


</div>
