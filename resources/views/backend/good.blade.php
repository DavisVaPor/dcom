<x-app-layout>
    <div class=" mt-1 w-full font-extrabold text-gray-600">
        <a href="{{ route('equipos') }}"
            class="my-auto inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            < Regresar 
        </a>
        <div class="">
            <h2 class="text-center -mt-8 mb-4 text-2xl text-green-600 uppercase"> {{ $good->denominacion }}</h2>
        </div>
        <div class="tab-content mb-2 text-sm">
            <div class="pl-6 pr-6 pb-2 text-gray-500 ">
                <div class="bg-white rounded-lg w-full mb-2 p-4 shadow">
                    <h2 class="mb-6 text-lg text-blue-500 uppercase"> Detalles del Bien</h2>
                    <div class="grid grid-cols-1 gap-2">
                        <div class=" col-span-2">
                            <div class="flex mb-2 border-b border-gray-600">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">NOMBRE</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span
                                        class=" text-gray-900 block font-bold uppercase">{{ $good->denominacion }}</span>
                                </div>
                            </div>
                            <div class="flex mb-2 border-b border-gray-600 items-center">
                                <div class="w-3/12">
                                    <span class="text-sm text-gray-900 block">COD. PATRIMONIAL</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    @if ($good->codPatrimonio)
                                        <span class=" text-gray-900 block font-bold uppercase">
                                            {{ $good->codPatrimonio }}
                                        </span>
                                    @else
                                        <span class=" text-red-600 block font-bold uppercase">
                                            Sin Codigo Patrimonial
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if ($good->cantidad > 1)
                                <div class="flex mb-2 border-b border-gray-600">
                                    <div class="w-3/12">
                                        <span class=" text-gray-900 block">CANTIDAD</span>
                                    </div>
                                    <div class="w-1/12">
                                        <span class=" text-gray-900 block">:</span>
                                    </div>
                                    <div class="w-9/12">
                                        <span
                                            class=" text-gray-900 block font-bold uppercase">{{ $good->cantidad }}</span>
                                    </div>
                                </div>
                            @endif
                            <div class="flex mb-2 border-b border-gray-600">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">MODELO</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span
                                        class=" text-gray-900 block font-bold uppercase">{{ $good->modelo }}</span>
                                </div>
                            </div>
                            <div class="flex mb-2 border-b border-gray-600">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">MARCA</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span
                                        class=" text-gray-900 block font-bold uppercase">{{ $good->marca }}</span>
                                </div>
                            </div>
                            <div class="flex mb-2 border-b border-gray-600">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">SERIE</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span class=" text-gray-900 block font-bold uppercase">
                                        @if ($good->serie)
                                            {{ $good->serie }}
                                        @else
                                            <p>Sin Numero de Serie</p>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="flex mb-2 border-b border-gray-600 items-center">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">CATEGORIA</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span
                                        class=" text-gray-900 block font-bold uppercase">{{ $good->category->name }}</span>
                                </div>
                            </div>
                            <div class="flex mb-2 border-b border-gray-600">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">COLOR</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    @if ($good->color)
                                        <span class=" text-gray-900 block font-bold">{{ $good->color }}</span>
                                    @else
                                        <span class=" text-gray-500 block font-bold">ESTANDAR</span>
                                    @endif

                                </div>
                            </div>
                            <div class="flex my-2 border-b border-gray-600 items-center">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">OPERATIVIDAD</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span class=" text-gray-500 block font-bold">
                                        @if ($good->operatividad == 'OPERATIVO')
                                            <p class="text-green-500">
                                                {{ $good->operatividad }}
                                            </p>
                                        @else
                                            <p class="text-red-500">
                                                {{ $good->operatividad }}
                                            </p>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="flex my-2 border-b border-gray-600 items-center">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">SITUACION</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span class=" text-gray-500 block font-bold">
                                        {{ $good->situacion }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex my-2 border-b border-gray-600 items-center">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">CONDICION</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span class=" text-gray-500 block font-bold">
                                        @if ($good->condicion == 'BUENO')
                                            <p class="text-green-500">
                                                {{ $good->condicion }}
                                            </p>
                                        @else
                                            @if ($good->condicion == 'REGULAR')
                                                <p class="text-yellow-500">
                                                    {{ $good->condicion }}
                                                </p>
                                            @else
                                                <p class="text-red-500">
                                                    {{ $good->condicion }}
                                                </p>
                                            @endif
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="flex my-2 border-b border-gray-600 items-center">
                                <div class="w-3/12">
                                    <span class=" text-gray-900 block">ESTADO</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span class=" text-gray-500 block font-bold">
                                        {{ $good->estado }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex mb-2 border-b border-gray-600">
                                <div class="w-3/12">
                                    <span class="text-sm text-gray-900 block">FECHA DE REGISTRO</span>
                                </div>
                                <div class="w-1/12">
                                    <span class=" text-gray-900 block">:</span>
                                </div>
                                <div class="w-9/12">
                                    <span
                                        class=" text-gray-900 block font-extrabold">{{ $good->created_at }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full font-extrabold text-gray-600">
        <div class="tab-content mb-2">
            <div class="pl-6 pr-6 pb-2 text-gray-500">
                <div class="bg-white rounded-lg w-full mb-2 p-4 shadow">
                    <h2 class="mb-4 text-lg text-blue-500 uppercase"> UbicaciÓn del Equipo</h2>
                    <div class="text-sm">
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class=" text-gray-900 block uppercase">UBICACCION</span>
                            </div>
                            <div class="w-1/12">
                                <span class=" text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class=" text-gray-900 block font-bold uppercase">
                                    E:{{ $good->station->name }}
                                </span>
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class=" text-gray-900 block uppercase">Provincia</span>
                            </div>
                            <div class="w-1/12">
                                <span class=" text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class=" text-gray-900 block font-bold uppercase">
                                    {{ $good->station->ubigeo->provincia }} 
                                </span>
                            </div>
                        </div>
                        <div class="flex mb-2 border-b border-gray-600">
                            <div class="w-3/12">
                                <span class=" text-gray-900 block uppercase">Distrito</span>
                            </div>
                            <div class="w-1/12">
                                <span class=" text-gray-900 block">:</span>
                            </div>
                            <div class="w-9/12">
                                <span class=" text-gray-900 block font-bold uppercase">
                                    {{ $good->station->ubigeo->distrito }} 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
