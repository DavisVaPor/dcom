<div>
    <div class="flex justify-end text-end text-blue-500">
        <button wire:click="editEstacion()"
            class=" flex hover:text-gray-900 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </button>Editar
        
   </div>

   <x-dialog-modal wire:model="modal">
    <x-slot name="title">
        <h1 class="font-bold text-gray-500 uppercase text-center">Editar Estacion: {{ $station->name }}</h1>
    </x-slot>

    <x-slot name="content">

        <div class="col-span-6 sm:col-span-4">
            <x-label class="text-sm font-bold border-gray-200 uppercase" for="name"
                value="{{ __('Nombre de Estacion *') }}" />

            <x-input class="resize-none w-full border rounded-md border-gray-300" wire:model='name'/>
            <x-input-error for="station.name" class="mt-2" />
        </div>

        <div class="mt-1 col-span-6 sm:col-span-4">
            <x-label class="text-sm font-bold border-gray-200 uppercase" for="ubicacion"
                value="{{ __('Ubicacion de la Estacion') }}" />
            <div class="flex items-center">
                <div>
                    <x-label class="text-sm font-bold border-gray-200 uppercase" for="provincia"
                        value="{{ __('Provincia') }}" />
                    <select class="rounded-lg text-sm mr-2" wire:model='provincia' name="provincia"
                        id="provincia">
                        <option value="">Selecciones</option>
                        <option value="Chachapoyas">Chachapoyas</option>
                        <option value="Bagua">Bagua</option>
                        <option value="Bongara">Bongara</option>
                        <option value="Luya">Luya</option>
                        <option value="Rodriguez de Mendoza">Rodriguez de Mendoza</option>
                        <option value="Condorcanqui">Condorcanqui</option>
                        <option value="Utcubamba">Utcubamba</option>
                    </select>
                </div>
                <div class="ml-5">
                    <x-label class="text-sm font-bold border-gray-200 uppercase" for="distrito"
                        value="{{ __('Distrito') }}" />
                    <select class="rounded-lg text-sm mr-2" wire:model='distrito' name="distrito" id="distrito">
                        <option selected value="">Distrito</option>
                        @if ($provincia)
                            @foreach ($ubigeos as $item)
                                <option selected value="{{ $item->id }}">{{ $item->distrito }}</option>
                            @endforeach
                        @endif
                    </select>
                    {{ $distrito }}
                </div>

            </div>
            <x-input-error for="ubigeo" class="mt-2" />
        </div>

        <div class="mt-1 col-span-6 sm:col-span-4">
            <x-label class="text-sm font-bold border-gray-200 uppercase" for="Coordenadas"
                value="{{ __('Coordenadas') }}" />
            <div class="flex justify-between">
                <x-input class="mx-1 resize-none w-full border rounded-md border-gray-300"
                    wire:model='latitud' />º
                <x-input class="mx-1 resize-none w-full border rounded-md border-gray-300"
                    wire:model='longitud' />º
                <x-input class="mx-1 resize-none w-full border rounded-md border-gray-300"
                    wire:model='altitud' />
            </div>

            <x-input-error for="station.lat" class="mt-2" />
            <x-input-error for="station.lon" class="mt-2" />
        </div>

        <div class="flex justify-between col-span-6 sm:col-span-4 mt-1">
            <div>
                <x-label class="text-sm font-bold border-gray-200 uppercase" for="codStation"
                    value="{{ __('Codigo de la Estacion') }}" />
                <x-input class="resize-none w-full border rounded-md border-gray-300"
                    wire:model.defer='codStation' name="codStation" />
            </div>

            <div>
                <x-label class="text-sm font-bold border-gray-200 uppercase" for="tipoPy"
                    value="{{ __('Tipo de Estacion') }}" />
                <select class="rounded-xl text-sm" name="tipoPy" id="tipoPy" wire:model='tipoPy'>
                    <option value="">Seleccione</option>
                    <option value="PACC">PACC</option>
                    <option value="CPACC">CPACC</option>
                    <option value="RADIO_HF">RADIO HF</option>
                    <option value="ALMACEN">ALMACEN</option>
                </select>
            </div>
        </div>

        @if ($tipoPy == 'PACC' || $tipoPy == 'CPACC')
            <div class="mt-1 col-span-6 sm:col-span-4">
                <x-label class="text-sm font-bold border-gray-200 uppercase" value="{{ __('Frecuencias') }}" />
                <div class="flex justify-between">
                    <x-input type="number" class="mx-1 resize-none w-full border rounded-md border-gray-300"
                        wire:model.defer='chanel' name="chanel" pla placeholder="Canal" />
                    @if ($tipoPy == 'CPACC')
                        <x-input type="text" class="mx-1 resize-none w-full border rounded-md border-gray-300"
                            wire:model.defer='fm' name="fm" pla
                            placeholder="Frecuencia Modulada" />
                    @endif
                </div>
            </div>
        @endif

        <div class="flex justify-between col-span-6 sm:col-span-4 my-2 items-center ">
            <div>
                <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="sistema"
                    value="{{ __('Sistema *') }}" />
                <select class="rounded-xl text-sm" name="station.sistema" id="sistema"
                    wire:model='sistema'>
                    <option value="">Seleccione</option>
                    <option value="VHF">VHF</option>
                    <option value="HF">HF</option>
                    <option value="NULL">NULL</option>
                </select>
                <x-input-error for="sistema" class="mt-2" />

            </div>

            <div>
                <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="tipo"
                    value="{{ __('Tipo *') }}" />
                <select class="rounded-xl text-sm" name="station.tipo" id="tipo"
                    wire:model='tipo'>
                    <option value="">Seleccione</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
                <x-input-error for="tipo" class="mt-2" />
            </div>

            <div>
                <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="estado"
                    value="{{ __('Estado *') }}" />
                <select class="rounded-xl text-sm" name="estado" id="estado"
                    wire:model='estado'>
                    <option value="">Seleccione</option>
                    <option value="OPERATIVO">OPERATIVO</option>
                    <option value="INOPERATIVO">INOPERATIVO</option>
                </select>
                <x-input-error for="estado" class="mt-2" />

            </div>

            <div>
                <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="situacion"
                    value="{{ __('Situacion') }}" />
                <select class="rounded-xl text-sm" name="situacion" id="situacion"
                    wire:model='situacion'>
                    <option value="">Seleccione</option>
                    <option value="VERIFICADO">VERIFICADO</option>
                    <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                    <option value="INEXISTENTE">INEXISTENTE</option>
                </select>
                <x-input-error for="station.situacion" class="mt-2" />

            </div>
        </div>

        <div class="flex justify-between col-span-6 sm:col-span-4 my-2 items-center ">
            <div>
                <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="energia"
                    value="{{ __('Energia') }}" />
                <select class="rounded-xl text-sm" name="energia" id="energia"
                    wire:model='energia'>
                    <option value="">Seleccione</option>
                    <option value="ELECTRICA">ELECTRICA</option>
                    <option value="FOTOVOLTAICO">FOTOVOLTAICO</option>
                    <option value="GENERADOR">GENERADOR</option>
                    <option value="OTRA">OTRA</option>
                    <option value="NO_TIENE">NO TIENE</option>
                </select>
                <x-input-error for="energia" class="mt-2" />

            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('modal',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ml-2" wire:click="saveStation()" wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-dialog-modal>
</div>
