<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="css/tailwind2.css" rel="stylesheet" type="text/css">
    <title>{{ $informe->name }}</title>

    <style>
        .flex {
            display: flex;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: right;
            line-height: 35px;
        }
    </style>

    @php
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    @endphp

</head>

<body class="font-sans">
    <div class="flex justify-between">
        <div style="float: right; font-size: 12px;">
            <p>Fecha : {{ date('j-m-y') }}</p>
            <p>Hora : {{ date('h:i:s') }}</p>
        </div>
        <header>
            <div class="font-bold text-xs">
                <h1>Gobierno Regional Amazonas</h1>
                <h1>Dirección Regional de Transportes y Comunicaciones</h1>
                <h1>Dirección de Comunicaciones</h1>
            </div>
        </header>

    </div>

    <p class="text-center text-2xl font-bold mt-6">
        INFORME DE ACTIVIDADES REALIZADAS
    </p>

    <div>
        <div class="flex">
            <p>Asunto: <span class="font-bold">{{ $informe->asunto }}</span></p>
        </div>

        <div class="flex">
            <p>Tipo: <span class="font-bold">{{ $informe->tipo }}</span></p>
        </div>

        <h2 class="font-bold flex justify-end items-center">
            <p>Periodo del {{ $informe->commission->fechainicio }} al {{ $informe->commission->fechafin }}
                ({{ $informe->commission->periodo }} Dias)</p>
        </h2>

        <div class="flex my-3 justify-between border-b border-gray-300 border-3">
            <h1 class="mr-5 text-lg font-bold text-gray-800">COMISIÓN</h1>
        </div>
        <a target="_blank" href="{{ route('commision.show', [$informe->commission]) }}"
            class="text-blue-500 font-semibold underline ml-10">
            #C-{{ $informe->commission->id }}: {{ $informe->commission->name }}
        </a>
        <div class="flex my-3 justify-between border-b border-gray-300 border-3">
            <h1 class="mr-5 text-lg font-bold text-gray-800 ">PERSONAL</h1>
        </div>
        <div class="ml-10">
            @if ($informe->commission->users->isNotEmpty())
                @foreach ($informe->commission->users as $user)
                    <div class="flex items-center">
                        <p class="font-bold text-sm">-{{ $user->name }}{{ ' ' . $user->apellido }} <span
                                class="font-normal">{{ ' : ' . $user->cargo }}</span></p>
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
                        <p class="font-semibold text-sm">-{{ $objective->name }}</p>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="flex my-3 justify-between border-b border-gray-300 border-3">
            <h1 class="mr-5 text-lg font-bold text-gray-800 ">ESTACIONES</h1>
        </div>

        <div class=" ml-10">
            @if ($informe->commission->tipo === 'MANTENIMIENTO')
                @foreach ($informe->commission->estations as $estation)
                    <p class="font-semibold text-base">
                        {{ $estation->name }}{{ $estation->sistema }}:{{ $estation->tipo }}</p>
                    <p class="font-semibold text-base underline">Datos Generales</p>
                    <h2>Ubicación</h2>
                    <p>
                        Provincia :{{ $estation->ubigeo->provincia }}
                    </p>
                    <p>
                        Distrito: {{ $estation->ubigeo->distrito }}
                    </p>
                    <div class="flex justify-between mb-2 border-b border-gray-600">
                        <div class="w-3/12">
                            <span class="text-base text-gray-900 block">LATITUD: {{ $estation->latitud }}S</span>
                        </div>

                        <div class="w-3/12">
                            <span class="text-base text-gray-900 block">LONGITUD: {{ $estation->longitud }}</span>
                        </div>
                    </div>
                    <div class="justify-between flex mb-2 border-b border-gray-600">
                        <div class="flex">
                            <span class="text-base text-gray-900 block">ENERGIA: {{ $estation->energia }}</span>
                        </div>

                        <div class="flex">
                            <span class="text-base text-gray-900 block">SINIESTRADO:
                                {{ $estation->siniestrado }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-base text-gray-900 block">ESTADO: {{ $estation->estado }}</span>
                        </div>
                    </div>
                    <div class="flex text-sm mb-2 border-b">
                        <div class="w-8/12">
                            <p class="text-base text-gray-900 block">CONTACTO RESPONSABLE: {{ $estation->responsable }}
                            </p>
                        </div>
                        <div class="w-3/12">
                            <span class="text-base text-gray-900 block">TELEFONO: {{ $estation->resptelefono }}</span>
                        </div>
                    </div>

                    @if ($informe->mantenimient->tipo)
                        <p>{{$informe->mantenimient->tipo}}</p>
                    @endif
                    

                    <div class="flex text-sm mb-2 border-b">
                        <div class="w-3/12">
                            <h1 class="font-semibold text-base underline">INVENTARIO DE LA ESTACION</h1>
                            <table class="text-sm rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
                                <tr class="border-b-2 border-gray-300">
                                    <th class="px-4 py-3">Cod. Pat. DRTC</th>
                                    <th class="px-4 py-3">Nombre del Equipo</th>
                                    <th class="px-4 py-3">Serie</th>
                                    <th class="px-4 py-3 text-center">Estado</th>
                                    <th class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                                            </path>
                                        </svg>
                                    </th>
                                </tr>
                                @forelse ($estation->articles as $article)
                                    <tr class="bg-gray-100 border-b border-gray-200">
                                        <td class="px-4 font-bold ">{{ $article->codPatrimonial }}</td>
                                        <td class="px-4 py-1">{{ $article->denominacion }}</td>
                                        <td class="px-4 py-1">{{ $article->nserie }}</td>
                                        <td class="px-4 py-1 text-center font-bold">
                                            @if ($article->estado == 'BUENO')
                                                <p class="text-green-500">
                                                    {{ $article->estado }}
                                                </p>
                                            @else
                                                @if ($article->estado == 'REGULAR')
                                                    <p class="text-yellow-500">
                                                        {{ $article->estado }}
                                                    </p>
                                                @else
                                                    <p class="text-red-500">
                                                        {{ $article->estado }}
                                                    </p>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-gray-100 border-b border-gray-200">
                                        <td colspan="6" class="px-4 py-3 text-center">
                                            No se encontraron registros
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                @endforeach

                
            @endif

            <table class="rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
                <tr class="text-left border-b-2 border-gray-300">
                    <th class="px-2 py-2 w-10/12 ml-2" colspan="2">REGISTRO DE ACTIVIDADES REALIZADAS</th>
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
    
                @forelse ($informe->activities as $activity)
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td class="px-2 font-bold text-xs text-center w-4">{{ $loop->iteration }}</td>
                        <td class="px-2 py-2 w-10/12 text-sm">{{ $activity->descripcion }}</td>
                    </tr>
                @empty
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td colspan="5" class="text-center my-2">.... Sin Registro Añadido....</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
    <footer class="">
        <p class="text-xs"> Direccion de Comunicaciones Amazonas &copy; {{ date('Y') }}</p>
        <p class="text-xs"> Direccion Regional de Transportes y Comunicaciones Amazonas</p>
    </footer>
</body>

</html>