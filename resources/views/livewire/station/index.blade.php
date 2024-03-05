<div>
    <div x-data="{
        openTab: 1,
        activeClass: 'text-blue-700 border bg-gray-100 rounded-lg font-bold',
        inactive: 'bg-white inline-block py-2 px-4 font-semibold'
    }">

        <div class="flex my-3">
            <input wire:model='search' class="form-control rounded-lg mr-sm-2 w-full m-auto mr-6" type="search"
                placeholder="Búsqueda" aria-label="Search">
            <div @click="openTab = 1" wire:click="$set('paginate',20)" class="mr-1 cursor-pointer">

                <a :class="openTab === 1 ? activeClass : inactive" class="bg-white py-2 px-4 flex items-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
            <div @click="openTab = 2" wire:click="$set('paginate',6)" class="mr-1 cursor-pointer">
                <a :class="openTab === 2 ? activeClass : inactive" class="bg-white py-2 px-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                </a>
            </div>
            <div class="flex">
                <x-button wire:click="addstation" class="bg-green-500 ml-3 hover:bg-green-800">
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
        </div>
        <div class="flex w-full justify-between my-3">
            <select class="rounded-lg text-sm mr-2" wire:model='provinciaSearch' name="" id="">
                <option selected value="">Provincias</option>
                <option value="101">Chachapoyas</option>
                <option value="102">Bagua</option>
                <option value="103">Bongara</option>
                <option value="104">Luya</option>
                <option value="105">Rodriguez de Mendoza</option>
                <option value="106">Condorcanqui</option>
                <option value="107">Utcubamba</option>
            </select>
            <select class="rounded-lg text-sm mr-2" wire:model='estado' name="" id="">
                <option selected value="">Estado</option>
                <option class="" value="OPERATIVO">Operativo</option>
                <option class="" value="INOPERATIVO">Inoperativo</option>
            </select>
            <select class="rounded-lg text-sm mr-2 " wire:model='tipoPy' name="" id="">
                <option selected value="">Proyecto</option>
                <option class="" value="PACC">PACC</option>
                <option class="" value="CPACC">CPACC</option>
                <option class="" value="Radio_HF">RADIO HF</option>
            </select>
            <select class="rounded-lg text-sm mr-2 " wire:model='sistema' name="" id="">
                <option selected value="">Sistema</option>
                <option class="" value="VHF">VHF</option>
                <option class="" value="HF">HF</option>
            </select>
            <select class="rounded-lg text-sm mr-2 " wire:model='tipo' name="" id="">
                <option selected value="">Tipo</option>
                <option class="" value="A">A</option>
                <option class="" value="B">B</option>
                <option class="" value="C">C</option>
            </select>
            <select class="rounded-lg text-sm mr-2 " wire:model='energia' name="" id="">
                <option selected value="">Energia</option>
                <option class="" value="SIN">Sin Energia</option>
                <option class="" value="ELECTRICA">Electrica</option>
                <option class="" value="SOLAR">Solar</option>
            </select> <select class="rounded-lg text-xs mr-2 " wire:model='siniestrado' name="" id="">
                <option selected value="">Siniestro</option>
                <option class="" value="SI">Si</option>
                <option class="" value="NO">No</option>
            </select>

            
        </div>


        @isset($estations)
            <div x-show="openTab === 1">
                <table class="table-auto rounded-t-lg w-full mx-auto bg-gray-500 text-gray-800">
                    <thead>
                        <tr class="border-b-2 border-gray-300 text-center text-white">
                            <th class="py-1">Estacion</th>
                            <th class="py-1">Ubigeo</th>
                            <th class="py-1">Latitud</th>
                            <th class="py-1">Longitud</th>
                            <th class="py-1">Maps</th>
                            <th class="py-1">Sistema</th>
                            <th class="py-1">Tipo</th>
                            <th class="py-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estations as $item)
                            <tr class="text-sm bg-gray-100 border-b border-gray-400 hover:bg-blue-100">
                                <td>
                                    <a href="{{ route('estacion.show', [$item]) }}" class="text-blue-700">
                                        {{ $item->name }}</a>
                                </td>
                                <td class="">{{ $item->ubigeo->id }}: {{ $item->ubigeo->provincia }} {{ $item->ubigeo->distrito }}
                                <td class="text-center">{{ $item->latitud }}</td>
                                <td class="text-center">{{ $item->longitud }}</td>
                                <td>
                                    <a href="https://www.google.com/maps/place/{{$item->latitud}}{{$item->longitud}}"
                                        class="text-green-500 hover:text-green-700 cursor-pointer mx-2 " target="_blank">
                                        <svg class="svg-inline--fa fa-globe fa-w-16 w-4 h-4 m-auto" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                            <path fill="currentColor"
                                                d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                                <td class="text-center">{{ $item->sistema }} </td>
                                <td class="text-center">{{ $item->tipo }}</td>
                                <td>
                                    @if ($item->estado == 'OPERATIVO')
                                        <p class="text-green-600">
                                            <abbr title="OPERATIVO">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </abbr>
                                        </p>
                                    @else
                                        <p class="text-red-600">
                                            <abbr title="INOPERATIVO">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </abbr>
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div x-show="openTab === 2">
                <div class="mx-auto rounded-md bg-gray-100 py-8 justify-center md:grid-cols-3 grid grid-cols-1 gap-2 ">
                    @foreach ($estations as $estation)
                        <div class="bg-white w-90 shadow-2xl rounded-xl">
                            <div class="p-2">
                                <a href="{{ route('estacion.show', [$estation->id]) }}"
                                    class="text-blue-700 flex items-center justify-center">
                                    <i>
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="broadcast-tower"
                                            class="svg-inline--fa fa-broadcast-tower fa-w-20 w-8 h-8 mr-2" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                            <path fill="currentColor"
                                                d="M150.94 192h33.73c11.01 0 18.61-10.83 14.86-21.18-4.93-13.58-7.55-27.98-7.55-42.82s2.62-29.24 7.55-42.82C203.29 74.83 195.68 64 184.67 64h-33.73c-7.01 0-13.46 4.49-15.41 11.23C130.64 92.21 128 109.88 128 128c0 18.12 2.64 35.79 7.54 52.76 1.94 6.74 8.39 11.24 15.4 11.24zM89.92 23.34C95.56 12.72 87.97 0 75.96 0H40.63c-6.27 0-12.14 3.59-14.74 9.31C9.4 45.54 0 85.65 0 128c0 24.75 3.12 68.33 26.69 118.86 2.62 5.63 8.42 9.14 14.61 9.14h34.84c12.02 0 19.61-12.74 13.95-23.37-49.78-93.32-16.71-178.15-.17-209.29zM614.06 9.29C611.46 3.58 605.6 0 599.33 0h-35.42c-11.98 0-19.66 12.66-14.02 23.25 18.27 34.29 48.42 119.42.28 209.23-5.72 10.68 1.8 23.52 13.91 23.52h35.23c6.27 0 12.13-3.58 14.73-9.29C630.57 210.48 640 170.36 640 128s-9.42-82.48-25.94-118.71zM489.06 64h-33.73c-11.01 0-18.61 10.83-14.86 21.18 4.93 13.58 7.55 27.98 7.55 42.82s-2.62 29.24-7.55 42.82c-3.76 10.35 3.85 21.18 14.86 21.18h33.73c7.02 0 13.46-4.49 15.41-11.24 4.9-16.97 7.53-34.64 7.53-52.76 0-18.12-2.64-35.79-7.54-52.76-1.94-6.75-8.39-11.24-15.4-11.24zm-116.3 100.12c7.05-10.29 11.2-22.71 11.2-36.12 0-35.35-28.63-64-63.96-64-35.32 0-63.96 28.65-63.96 64 0 13.41 4.15 25.83 11.2 36.12l-130.5 313.41c-3.4 8.15.46 17.52 8.61 20.92l29.51 12.31c8.15 3.4 17.52-.46 20.91-8.61L244.96 384h150.07l49.2 118.15c3.4 8.16 12.76 12.01 20.91 8.61l29.51-12.31c8.15-3.4 12-12.77 8.61-20.92l-130.5-313.41zM271.62 320L320 203.81 368.38 320h-96.76z">
                                            </path>
                                        </svg>
                                    </i>
                                    <h2 class="text-lg font-bold text-blue-700 text-center uppercase underline">
                                        {{ $estation->name }}</h2>
                                </a>
                                <div class="flex">
                                    <h3 class=" ml-3 my-2 text-base font-semibold">Latitud :</h3>
                                    <p class="font-light  text-gray-500 text-base ml-3 my-2">
                                        {{ $estation->latitud }} S
                                    </p>
                                </div>
                                <div class="flex">
                                    <h3 class=" ml-3 my-2 text-base font-semibold">Longitud :</h3>
                                    <p class="font-light text-gray-500 text-base ml-3 my-2">
                                        {{ $estation->longitud }} W
                                    </p>
                                </div>
                                <div class="flex">
                                    <h3 class=" ml-3 my-2 text-base font-semibold">Sistema :</h3>
                                    <p class="font-normal text-blue-700 text-base ml-3 my-2">{{ $estation->sistema }}
                                    </p>
                                </div>
                                <div class="flex">
                                    <h3 class=" ml-3 my-2 text-base font-semibold">Tipo :</h3>
                                    <p class="font-normal text-blue-700 text-base ml-3 my-2">{{ $estation->tipo }}
                                    </p>
                                </div>
                                <div class="flex">
                                    <h3 class=" ml-3 my-2 text-base font-semibold">Provincia :</h3>
                                    <p class="font-normal uppercase text-blue-700 text-base ml-2 my-2">
                                        {{ $estation->ubigeo->provincia }}</p>
                                </div>
                                <div class="flex">
                                    <h3 class=" ml-3 my-2 text-base font-semibold">Distrito :</h3>
                                    <p class="font-normal uppercase text-blue-700 text-base ml-2 my-2">
                                        {{ $estation->ubigeo->distrito }}</p>
                                </div>
                                <div class="flex justify-between items-center mt-1 text-center">
                                    @if ($estation->estado == 'OPERATIVO')
                                        <p
                                            class="font-bold w-full px-2 py-1 rounded-lg text-white text-base ml-3 bg-green-800 my-2">
                                            OPERATIVO
                                        </p>
                                    @else
                                        <p
                                            class="font-bold  w-full px-2 py-1 rounded-lg text-white text-base ml-3 bg-red-800 my-2">
                                            INOPERATIVO
                                        </p>
                                    @endif
                                    <div class="mx-2">
                                        <a href="{{ $estation->urlgooglearth }}"
                                            class="text-green-500 hover:text-green-700 cursor-pointer mx-2 "
                                            target="_blank">
                                            <svg class="svg-inline--fa fa-globe fa-w-16 w-8 h-8 m-auto" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                <path fill="currentColor"
                                                    d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="container mx-auto rounded-md bg-red-200 opacity-50 py-8 justify-center grid-cols-1 gap-2 ">
                <p class="text-center text-gray-800 font-bold">..::No se encuentra registros::..</p>
            </div>
        @endisset
        <p class="text-right mt-2">Total de Registros: {{$estations->count()}}</p>
        {{ $estations->links() }}
    </div>

    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modal">
        <x-slot name="title">
            <h1 class="font-bold text-gray-500 uppercase text-center">Registro de una Estacion</h1>
        </x-slot>

        <x-slot name="content">

            <div class="col-span-6 sm:col-span-4">
                <x-label class="text-sm font-bold border-gray-200 uppercase" for="name"
                    value="{{ __('Nombre de Estacion *') }}" />

                <x-input class="resize-none w-full border rounded-md border-gray-300" wire:model.defer='station.name'
                    name="station.name" />
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
                            <option value="Rodriguez">Rodriguez de Mendoza</option>
                            <option value="Condorcanqui">Condorcanqui</option>
                            <option value="Utcubamba">Utcubamba</option>
                        </select>
                    </div>
                    <div class="ml-5">
                        <x-label class="text-sm font-bold border-gray-200 uppercase" for="ubigeo"
                            value="{{ __('Distrito') }}" />
                        <select class="rounded-lg text-sm mr-2" wire:model='ubigeo' name="ubigeo" id="ubigeo">
                            <option selected value="">Distrito</option>
                            @if ($provincia)
                                @foreach ($ubigeos as $item)
                                    <option selected value="{{ $item->id }}">{{ $item->distrito }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                </div>
                <x-input-error for="ubigeo" class="mt-2" />
            </div>

            <div class="mt-1 col-span-6 sm:col-span-4">
                <x-label class="text-sm font-bold border-gray-200 uppercase" for="Coordenadas"
                    value="{{ __('Coordenadas') }}" />
                <div class="flex justify-between">
                    <x-input class="mx-1 resize-none w-full border rounded-md border-gray-300"
                        wire:model.defer='station.lat' name="station.lat" placeholder="Latitud *" />
                    <x-input class="mx-1 resize-none w-full border rounded-md border-gray-300"
                        wire:model.defer='station.lon' name="station.lon" placeholder="Longitud *" />
                    <x-input class="mx-1 resize-none w-full border rounded-md border-gray-300"
                        wire:model.defer='altitud' name="altitud" placeholder="Altitud" />
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
                    <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="station.sistema"
                        value="{{ __('Sistema *') }}" />
                    <select class="rounded-xl text-sm" name="station.sistema" id="station.sistema"
                        wire:model='station.sistema'>
                        <option value="">Seleccione</option>
                        <option value="VHF">VHF</option>
                        <option value="HF">HF</option>
                    </select>
                    <x-input-error for="station.sistema" class="mt-2" />

                </div>

                <div>
                    <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="station.tipo"
                        value="{{ __('Tipo *') }}" />
                    <select class="rounded-xl text-sm" name="station.tipo" id="station.tipo"
                        wire:model='station.tipo'>
                        <option value="">Seleccione</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                    <x-input-error for="station.tipo" class="mt-2" />
                </div>

                <div>
                    <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="station.estado"
                        value="{{ __('Estado *') }}" />
                    <select class="rounded-xl text-sm" name="station.estado" id="station.estado"
                        wire:model='station.estado'>
                        <option value="">Seleccione</option>
                        <option value="OPERATIVO">OPERATIVO</option>
                        <option value="INOPERATIVO">INOPERATIVO</option>
                    </select>
                    <x-input-error for="station.estado" class="mt-2" />

                </div>

                <div>
                    <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="situacion"
                        value="{{ __('Situacion') }}" />
                    <select class="rounded-xl text-sm" name="station.situacion" id="situacion"
                        wire:model='station.situacion'>
                        <option value="">Seleccione</option>
                        <option value="VERIFICADO">VERIFICADO</option>
                        <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                        <option value="INEXISTENTE">INEXISTENTE</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-between col-span-6 sm:col-span-4 my-2 items-center ">
                <div>
                    <x-label class="text-sm font-bold mr-2 border-gray-200 uppercase" for="station.energia"
                        value="{{ __('Energia') }}" />
                    <select class="rounded-xl text-sm" name="station.energia" id="station.energia"
                        wire:model='station.energia'>
                        <option value="">Seleccione</option>
                        <option value="ELECTRICA">ELECTRICA</option>
                        <option value="FOTOVOLTAICO">FOTOVOLTAICO</option>
                        <option value="GENERADOR">GENERADOR</option>
                        <option value="OTRA">OTRA</option>
                        <option value="NO_TIENE">NO TIENE</option>
                    </select>
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
