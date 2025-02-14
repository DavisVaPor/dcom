<x-app-layout>

    @livewire('report.show', ['informe' => $informe], key($informe->id))

        <div class=" mt-2 font-extrabold text-gray-600">
            <h2 class="text-lg  text-center">INF {{ $informe->id }}-{{ $informe->asunto }}</h2>
            <div class="flex justify-between items-center">
                <h2 class="mr-4">
                    <p>Tipo:
                        <span class="font-bold underline ">
                            @if ($informe->tipo === 'MANTENIMIENTO')
                                MANTENIEMIENTO DE LOS SISTEMAS DE COMUNICACIONES
                            @else
                                @if ($informe->tipo === 'SUPERVISION')
                                    SUPERVISION DE LOS SERVICIOS DE TELECOMUNICACIONES
                                @else
                                    PROMOCION DE LAS TELECOMUNIACIONES
                                @endif
                            @endif
                        </span>
                    </p>
                </h2>
                <h2 class="font-bold flex justify-end items-center">
                    Estado:
                    @if ($informe->estado == 'BORRADOR')
                        <div
                            class="text-yellow-500 px-2 py-3 text-sm text-center  opacity-70 bg-clip-content font-extrabold rounded-lg">
                            {{ $informe->estado }}
                        </div>
                    @else
                        @if ($informe->estado == 'PRESENTADO')
                            <div class="text-green-500 text-sm text-center bg-clip-content font-extrabold rounded-xl">
                                {{ $informe->estado }}
                            </div>
                        @else
                            @if ($informe->estado == 'REVISADO')
                                <div class="text-blue-500 text-sm text-center bg-clip-content font-extrabold rounded-xl">
                                    {{ $informe->estado }}
                                </div>
                            @else
                                <div class="text-gray-500 text-sm text-center bg-clip-content font-extrabold rounded-xl">
                                    {{ $informe->estado }}
                                </div>
                            @endif
                        @endif
                    @endif
                </h2>
            </div>
            <div>
                <h2 class="font-bold flex justify-end items-center">
                    <p>Periodo del <span class="underline">{{ $informe->commission->fecha_inicio }}</span> al <span class="underline">{{ $informe->commission->fecha_fin }}</span>
                        ({{ $informe->commission->periodo }} Dias)</p>
                </h2>
            </div>
        </div>

        <section>
            <div class="flex my-3 justify-between border-b border-gray-300 border-3">
                <h1 class="mr-5 text-lg font-bold text-gray-800">COMISIÓN</h1>
            </div>
            <a target="_blank" href="{{ route('commision.show', [$informe->commission]) }}"
                class="text-blue-500 font-semibold underline ml-10">
                #C-{{ $informe->commission->id }}: {{ $informe->commission->comision }}
            </a>

            <div class="flex my-3 justify-between border-b border-gray-300 border-3">
                <h1 class="mr-5 text-lg font-bold text-gray-800 ">PERSONAL</h1>
            </div>
            <div class=" ml-10">
                @if ($informe->commission->users->isNotEmpty())
                    @foreach ($informe->commission->users as $user)
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="font-bold">{{ $user->name }}{{ ' ' . $user->apellido }} <span class="font-normal">{{ ' : ' . $user->cargo }}</span></p>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="flex my-3 justify-between border-b border-gray-300 border-3">
                <h1 class="mr-5 text-lg font-bold text-gray-800 ">OBJETIVOS</h1>
            </div>

            <div class=" ml-10">
                @if ($informe->commission->objetives->isNotEmpty())
                    @foreach ($informe->commission->objetives as $objective)
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="font-bold">{{ $objective->objetivo }}</p>
                        </div>
                    @endforeach
                @endif
            </div>

            @if ($informe->commission->tipo === 'SUPERVISION' || $informe->commission->tipo === 'PROMOCION')
                <div class="flex my-3 justify-between border-b border-gray-300 border-3">
                    <h1 class="mr-5 text-lg font-bold text-gray-800">LUGARES A VISITAR</h1>
                </div>
                <div class="ml-10 items-center">
                    <span class="font-bold uppercase underline">Provincia:Distrito</span>
                    @foreach ($informe->commission->ubigeo as $item)
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <p class="font-bold uppercase">
                                {{ $item->provincia }} : <span class="font-normal">{{ $item->distrito }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($informe->commission->tipo === 'MANTENIMIENTO')
                @livewire('report.mantenimient.mantenimient', ['informe' => $informe], key($informe->id))    

                <div class="justify-content-between">
                    <div>
                        <style>
                            .tab {
                                overflow: hidden;
                            }

                            .tab-content {
                                max-height: 0;
                                transition: all 0.5s;
                            }

                            input:checked+.tab-label .test {
                                background-color: #000;
                            }

                            input:checked+.tab-label .test svg {
                                transform: rotate(180deg);
                                stroke: #fff;
                            }

                            input:checked+.tab-label::after {
                                transform: rotate(90deg);
                            }

                            input:checked~.tab-content {
                                max-height: 100vh;
                            }
                        </style>

                    </div>
                </div>
            @endif


        </section>

        @if ($informe->commission->tipo == 'SUPERVISION')
            <section>
                @livewire('report.supervision.mediciones',  ['informe' => $informe], key($informe->id))
            </section>

            <section>
                @livewire('report.supervision.constantaciones',  ['informe' => $informe], key($informe->id))
            </section>
        @endif
        @if ($informe->tipo == 'PROMOCION')
            <section>
                @livewire('report.promocion.promocion',  ['informe' => $informe], key($informe->id))
            </section>
        @endif

</x-app-layout>