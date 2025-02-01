<div>
    <div class="flex my-3 justify-between items-center border-b border-gray-300 border-3">
        <h1 class="mr-5 text-lg font-bold text-gray-800">ESTACIONES</h1>
        <div class="flex justify-end items-center">
            @if ($informe->estado == 'BORRADOR')
                <div class="justify-end mr-4 my-2">
                    <x-button wire:click="addStationCommission">
                        Añadir <x-icons.plus-circle class="ml-1" />
                    </x-button>
                </div>
            @endif
        </div>
    </div>


    <div class="tabs">
        @foreach ($informe->commission->stations as $estation)
            <div class="border-b tab">
                <div class="relative">
                    <input class="w-full h absolute z-10 cursor-pointer opacity-0 h-5 top-6" type="checkbox"
                        id="chck1">
                    <header class="flex justify-between items-center p-5 pl-8 pr-8 cursor-pointer select-none tab-label"
                        for="chck1">
                        <span class="text-grey-darkest text-xl font-bold">
                            Estación : E-{{ $estation->id }} {{ $estation->name }}
                        </span>
                        <div class="rounded-full border border-grey w-7 h-7 flex items-center justify-center test">
                            <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24"
                                stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <polyline points="6 9 12 15 18 9">
                                </polyline>
                            </svg>
                        </div>
                    </header>
                    <div class="tab-content mb-1 h-full">
                        <div class="flex">
                            <div class="text-base text-gray-900 w-1/2">
                                <span class="underline">UBICACION</span>
                                <div class="flex justify-between">
                                    <p class="mr-4">REGION:<span
                                            class="font-extrabold  ml-2">{{ $estation->ubigeo->region }}</span></p>
                                    <p class="mx-4">PROVINCIA:<span
                                            class="font-extrabold ml-2">{{ $estation->ubigeo->provincia }}</span></p>
                                    <p class="mx-4">DISTRITO<span
                                            class="font-extrabold ml-2">{{ $estation->ubigeo->distrito }}</span></p>
                                </div>
                                <div class="text-base text-gray-900">
                                    <span class="underline">COORDENADAS</span>
                                    <div class="flex justify-between">
                                        <p class="mr-4">LATITUD:<span
                                                class="font-extrabold  ml-2">{{ $estation->latitud }} S</span></p>
                                        <p class="mx-4">LONGITUD:<span
                                                class="font-extrabold  ml-2">{{ $estation->longitud }} W</span></p>
                                        <p class="mx-4">ALTITUD:<span
                                                class="font-extrabold  ml-2">{{ $estation->altitud }} m.s.n.m.</span>
                                        </p>
                                    </div>
                                    <div class="text-base text-gray-900">
                                        <div class="flex justify-between">
                                            <p class="mx-4">MAPS:<span class="font-extrabold  ml-2">
                                                    <a href="https://www.google.com/maps/place/{{ $estation->latitud }}{{ $estation->longitud }}"
                                                        class="text-green-500 hover:text-green-700 cursor-pointer "
                                                        target="_blank">
                                                        <svg class="svg-inline--fa fa-globe fa-w-16 w-4 h-4 "
                                                            role="img" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 496 512">
                                                            <path fill="currentColor"
                                                                d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-base text-gray-900 w-1/2">
                                <span class="underline">PROYECTO</span>
                                <div class="flex justify-between">
                                    <p class="mr-4">TIPO:<span
                                            class="font-extrabold  ml-2">{{ $estation->tipoPy }}</span></p>
                                    <p class="mx-4">SISTEMA:<span
                                            class="font-extrabold ml-2">{{ $estation->sistema }}</span></p>
                                    <p class="mx-4">ESTACION:<span
                                            class="font-extrabold ml-2">{{ $estation->tipo }}</span></p>
                                </div>
                                <div class="text-base text-gray-900">
                                    <span class="underline">DETALLES</span>
                                    <div class="flex justify-between">
                                        <p class="mr-4">ESTADO:<span
                                                class="font-extrabold  ml-2">{{ $estation->estado }}</span></p>
                                        <p class="mx-4">ENERGIA:<span
                                                class="font-extrabold  ml-2">{{ $estation->energia }}</span></p>
                                        <p class="mx-4">SINIESTRADO:<span
                                                class="font-extrabold  ml-2">{{ $estation->siniestrado }}</span></p>
                                    </div>
                                </div>

                                <div class="text-base text-gray-900">
                                    <div class="flex justify-between">
                                        <p class="mx-4">CONTACTO:<span
                                                class="font-extrabold  ml-2">{{ $estation->contacto_name }}</span></p>
                                        <p class="mx-4">TELEFONO:<span
                                                class="font-extrabold  ml-2">{{ $estation->contacto_numero }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" pb-2 text-gray-500">
                            <div class=" rounded-lg w-full mt-2 p-2">
                                <section>
                                    <div x-data="{
                                        openTab: 1,
                                        activeClass: 'text-blue-700 border bg-gray-100 rounded-lg font-bold',
                                        inactive: 'bg-gray-100 inline-block py-2 px-4 font-semibold'
                                    };">
                                        <ul class="list-reset flex mt-4">
                                            <li @click="openTab = 1" class="mr-1 cursor-pointer">
                                                <a :class="openTab === 1 ? activeClass : inactive"
                                                    class="bg-gray-100 py-2 px-2 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="tools"
                                                        class="h-4 w-4 svg-inline--fa fa-eye fa-w-18 mr-2"
                                                        role="img" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M501.1 395.7L384 278.6c-23.1-23.1-57.6-27.6-85.4-13.9L192 158.1V96L64 0 0 64l96 128h62.1l106.6 106.6c-13.6 27.8-9.2 62.3 13.9 85.4l117.1 117.1c14.6 14.6 38.2 14.6 52.7 0l52.7-52.7c14.5-14.6 14.5-38.2 0-52.7zM331.7 225c28.3 0 54.9 11 74.9 31l19.4 19.4c15.8-6.9 30.8-16.5 43.8-29.5 37.1-37.1 49.7-89.3 37.9-136.7-2.2-9-13.5-12.1-20.1-5.5l-74.4 74.4-67.9-11.3L334 98.9l74.4-74.4c6.6-6.6 3.4-17.9-5.7-20.2-47.4-11.7-99.6.9-136.6 37.9-28.5 28.5-41.9 66.1-41.2 103.6l82.1 82.1c8.1-1.9 16.5-2.9 24.7-2.9zm-103.9 82l-56.7-56.7L18.7 402.8c-25 25-25 65.5 0 90.5s65.5 25 90.5 0l123.6-123.6c-7.6-19.9-9.9-41.6-5-62.7zM64 472c-13.2 0-24-10.8-24-24 0-13.3 10.7-24 24-24s24 10.7 24 24c0 13.2-10.7 24-24 24z">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm">Actvidades</span>
                                                </a>
                                            </li>

                                            <li @click="openTab = 2" class="mr-1 cursor-pointer">

                                                <a :class="openTab === 2 ? activeClass : inactive"
                                                    class="bg-gray-100 py-2 px-2 flex items-center ">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="boxes"
                                                        class="h-6 w-6 svg-inline--fa fa-boxes fa-w-18 mr-2"
                                                        role="img" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 576 512">
                                                        <path fill="currentColor"
                                                            d="M560 288h-80v96l-32-21.3-32 21.3v-96h-80c-8.8 0-16 7.2-16 16v192c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16V304c0-8.8-7.2-16-16-16zm-384-64h224c8.8 0 16-7.2 16-16V16c0-8.8-7.2-16-16-16h-80v96l-32-21.3L256 96V0h-80c-8.8 0-16 7.2-16 16v192c0 8.8 7.2 16 16 16zm64 64h-80v96l-32-21.3L96 384v-96H16c-8.8 0-16 7.2-16 16v192c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16V304c0-8.8-7.2-16-16-16z">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm">Inventario</span>
                                                </a>
                                            </li>

                                            {{-- <li @click="openTab = 3" class="mr-1 cursor-pointer">
                                                <a :class="openTab === 3 ? activeClass : inactive"
                                                    class="bg-gray-100 py-2 px-2 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                        class="h-4 w-4 svg-inline--fa fa-eye fa-w-18 mr-2">
                                                        <path fill="currentColor"
                                                            d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z" />
                                                    </svg>
                                                    <span class="text-sm">Requerimientos</span>
                                                </a>
                                            </li> --}}

                                            <li @click="openTab = 4" class="mr-1 cursor-pointer">
                                                <a :class="openTab === 4 ? activeClass : inactive"
                                                    class="bg-gray-100 py-2 px-2 flex items-center">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="eye"
                                                        class="h-4 w-4 svg-inline--fa fa-eye fa-w-18 mr-2"
                                                        role="img" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 576 512">
                                                        <path fill="currentColor"
                                                            d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm">Observaciones</span>
                                                </a>
                                            </li>

                                            <li @click="openTab = 5" class="mr-1 cursor-pointer">
                                                <a :class="openTab === 5 ? activeClass : inactive"
                                                    class="bg-gray-100 py-2 px-2 flex items-center ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        class="h-4 w-4 mr-2">
                                                        <path fill="currentColor"
                                                            d="M449.9 39.96l-48.5 48.53C362.5 53.19 311.4 32 256 32C161.5 32 78.59 92.34 49.58 182.2c-5.438 16.81 3.797 34.88 20.61 40.28c16.97 5.5 34.86-3.812 40.3-20.59C130.9 138.5 189.4 96 256 96c37.96 0 73 14.18 100.2 37.8L311.1 178C295.1 194.8 306.8 223.4 330.4 224h146.9C487.7 223.7 496 215.3 496 204.9V59.04C496 34.99 466.9 22.95 449.9 39.96zM441.8 289.6c-16.94-5.438-34.88 3.812-40.3 20.59C381.1 373.5 322.6 416 256 416c-37.96 0-73-14.18-100.2-37.8L200 334C216.9 317.2 205.2 288.6 181.6 288H34.66C24.32 288.3 16 296.7 16 307.1v145.9c0 24.04 29.07 36.08 46.07 19.07l48.5-48.53C149.5 458.8 200.6 480 255.1 480c94.45 0 177.4-60.34 206.4-150.2C467.9 313 458.6 294.1 441.8 289.6z" />
                                                    </svg>

                                                    <span class="text-sm">Movimientos</span>
                                                </a>
                                            </li>

                                            <li @click="openTab = 6" class="mr-1 cursor-pointer">
                                                <a :class="openTab === 6 ? activeClass : inactive"
                                                    class="bg-gray-100 py-2 px-2 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        class="w-6 h-6 mr-2">
                                                        <path fill="currentColor"
                                                            d="M447.1 32h-384C28.64 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM111.1 96c26.51 0 48 21.49 48 48S138.5 192 111.1 192s-48-21.49-48-48S85.48 96 111.1 96zM446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z" />
                                                    </svg>
                                                    <span class="text-xs">Galeria</span>
                                                </a>
                                            </li>

                                            <li @click="openTab = 7" class="mr-1 cursor-pointer">
                                                <a :class="openTab === 7 ? activeClass : inactive"
                                                    class="bg-gray-100 py-2 px-2 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z">
                                                        </path>
                                                        <path
                                                            d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm">Acta</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div x-show="openTab === 2">
                                            @livewire('report.mantenimient.inventary', ['estation' => $estation, 'informe' => $informe], key($estation->id))
                                        </div>
                                        <div x-show="openTab === 1">
                                            @livewire('report.mantenimient.activity', ['estation' => $estation, 'informe' => $informe], key($estation->id))
                                        </div>
                                        {{-- <div x-show="openTab === 3">
                                            @livewire('report.mantenimient.requerimients', ['estation' => $estation, 'informe' => $informe], key($estation->id))
                                        </div> --}}
                                        <div x-show="openTab === 4">
                                            @livewire('report.mantenimient.observations', ['estation' => $estation, 'informe' => $informe], key($estation->id))
                                        </div>
                                        <div x-show="openTab === 5">
                                            @livewire('report.mantenimient.movimients', ['estation' => $estation, 'informe' => $informe], key($estation->id))
                                        </div>
                                        <div x-show="openTab === 6">
                                            @livewire('report.mantenimient.galery', ['estation' => $estation, 'informe' => $informe], key($estation->id))
                                        </div>
                                        <div x-show="openTab === 7">
                                            @livewire('report.mantenimient.actas', ['estation' => $estation, 'informe' => $informe], key($estation->id))
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    {{-- Modal de Añadir --}}
    {{-- <dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Añadir Estacion</h1>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <label class="text-base font-bold border-gray-200" for="name"
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
                            </tr>
                            @foreach ($estations as $estation)
                                @if (!$informe->commission->stations->contains($station->id))
                                    @if ($estation->id != '1')
                                        <tr class="bg-gray-100 border-b border-gray-200 text-sm hover:bg-blue-900">
                                            <td class="px-1">
                                                <input class="rounded-2xl" wire:model='selectedEstation'
                                                    value="{{ $estation->id }}" type="radio">    
                                            </td>
                                            <td class="px-2 py-1">{{ $estation->name }}</td>
                                            <td class="px-2 py-1">{{ $estation->ubigeo->provincia }}</td>
                                            <td class="px-2 py-1">{{ $estation->ubigeo->distrito }}</td>
                                        </tr>                        
                                    @endif
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
            <secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </secondary-button>

            <button class="ml-2" wire:click="addEstacion({{ $selectedEstation }})"
                wire:loading.attr="disabled">
                {{ __('Añadir') }}
            </button>
        </x-slot>
    </dialog-modal> --}}


</div>
