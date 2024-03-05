<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estacion') }}
        </h2>
    </x-slot>
    <div class="text-center text-3xl my-2 font-extrabold text-green-600">
        <h1>ESTACION: {{ $estation->name }}</h1>
    </div>

    <div class="flex">
        <div class="tab-content mb-2 w-7/12">
            <div class="pb-2 ">
                <div class="bg-white rounded-lg w-full mb-2 p-4 shadow">
                    <div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">PROVINCIA</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span
                                    class="text-base block font-bold uppercase">{{ $estation->ubigeo->provincia }}</span>
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">DISTRITO</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span
                                    class="text-base block font-bold uppercase">{{ $estation->ubigeo->distrito }}</span>
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">LATITUD</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-bold uppercase">{{ $estation->latitud }}
                                    SUR</span>
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">LONGITUD</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-bold uppercase">{{ $estation->longitud }}
                                    OESTE</span>
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">ALTITUD</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-bold uppercase">
                                    @if ($estation->altitud)
                                        {{ $estation->altitud }} m.s.n.m.
                                    @else
                                        Sin registro
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">ESTADO</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                {{ $estation->estado }}
                                {{-- <span class="text-base  block font-extrabold">
                                    @livewire('estation.estado-update', ['estation' => $estation], key($estation->id))
                                </span> --}}
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">PROYECTO</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <p class="text-base  block font-extrabold items-center">
                                    {{ $estation->tipoPy }}
                                    <span class="text-sm font-normal">
                                        (@if ($estation->tipoPy == 'PACC')
                                            @if ($estation->tipo != 'C')
                                                CHANEL: {{ $estation->frec_canal }}
                                            @endif
                                        @endif

                                        @if ($estation->tipoPy == 'CPACC')
                                            @if ($estation->tipo != 'C')
                                                CHANEL: {{ $estation->frec_canal }}
                                                FM: {{ $estation->frec_fm }}
                                            @endif
                                        @endif)
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">SISTEMA</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-extrabold">{{ $estation->sistema }}</span>
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">TIPO</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-extrabold">{{ $estation->tipo }}</span>
                            </div>
                        </div>

                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">ENERGIA</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-extrabold">{{ $estation->energia }}</span>
                            </div>
                        </div>

                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">SITUACION</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-extrabold">{{ $estation->situacion }}</span>
                            </div>
                        </div>
                        {{-- <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">Responsable</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-extrabold">
                                    @if ($estation->responsable)
                                        {{ $estation->responsable }}
                                    @else
                                        Sin registro
                                    @endif
                                </span>
                            </div>
    
                        </div> --}}
                        {{-- <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">Telefono</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class="text-base  block font-extrabold">
                                    @if ($estation->resptelefono)
                                        {{ $estation->resptelefono }}
                                    @else
                                        Sin registro
                                    @endif
                                </span>
                            </div>
                        </div> --}}

                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class="text-base text-gray-900 block">Google Maps</span>
                            </div>
                            <div class="w-1/12">
                                <span class="text-base text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <a class="text-base">
                                    <x-icons.location-marker
                                        class="text-green-500 hover:text-green-700 cursor-pointer w-8 h-8" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content ml-2 mb-2 w-5/12 h-auto bg-white rounded-lg  p-4 shadow">
            <h1 class="text-center uppercase text-blue-500 font-semibold"> Imagen de la Estacion</h1>
            <img class="h-96 w-full " src="\img\muestra.jpg" alt="">
        </div>
    </div>



</x-app-layout>
