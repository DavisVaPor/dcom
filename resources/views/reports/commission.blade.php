<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <link href="css/tailwind2.css" rel="stylesheet" type="text/css">


    <style>
        footer {
            position: fixed;
            bottom: -30px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            line-height: 35px;
        }
    </style>

    @php
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    @endphp
</head>

<body>
    <div class="flex justify-between">
        <div style="float: right; font-size: 12px;">
            <p>Fecha : {{ date('j-m-y') }}</p>
            <p>Hora : {{ date('h:i:s') }}</p>
        </div>
        <header>
            <div class="font-bold text-xs">
                <h3>Gobierno Regional Amazonas</h3>
                <h3>Direccion Regional de Transportes y Comunicaciones</h3>
                <h3>Direccion de Comunicaciones</h3>
            </div>
        </header>

        <body class="font-sans">
            <div>
                <p>reg. DCOM-{{ $commission->numero }}-{{ $commission->anho }}</p>
            </div>

            <p class="text-center text-2xl font-bold mt-6">
                COMISIÓN DE SERVICIO
            </p>

            <div>
                <div class="flex">
                    <p>Asunto: <span class="font-bold">{{ $commission->comision }}</span></p>
                </div>
                <div class="flex">
                    @if ($commission->tipo === 'MANTENIMIENTO')
                        <p>Servicio: <span class="font-bold">MANTENIMIENTO DE LOS SISTEMAS DE TELECOMUNICACIÓN</span>
                        </p>
                    @else
                        @if ($commission->tipo === 'SUPERVISION')
                            <p>Servicio: <span class="font-bold">SUPERVISION DE LOS SERVICIOS DE TELECOMUNICACIONES</span></p>
                        @else
                            <p>Servicio: <span class="font-bold">PROMOCIÓN EN MATERIA DE TELECOMUNIACIONES</span></p>
                        @endif
                    @endif
                </div>
                <div class="flex">
                    <p>Período 
                        <span class="font-bold">
                            @if ($commission->fecha_inicio === $commission->fecha_fin)
                                {{ Str::after($commission->fecha_inicio, Str::between($commission->fecha_inicio, '-', '-') . '-') }}
                                {{ $meses[date(Str::between($commission->fecha_inicio, '-', '-')) - 1] }}
                                {{ Str::before($commission->fecha_inicio, '-') }}
                            @else
                                del
                                {{ Str::after($commission->fecha_inicio, Str::between($commission->fecha_inicio, '-', '-') . '-') }}
                                {{ $meses[date(Str::between($commission->fecha_inicio, '-', '-')) - 1] }}
                                {{ Str::before($commission->fecha_inicio, '-') }}
                                al
                                {{ Str::after($commission->fecha_fin, Str::between($commission->fecha_fin, '-', '-') . '-') }}
                                {{ $meses[date(Str::between($commission->fecha_fin, '-', '-')) - 1] }}
                                {{ Str::before($commission->fecha_fin, '-') }}
                            @endif
                        </span>
                        ({{ $commission->periodo }} dias)
                    </p>
                </div>

                <div class="my-8">
                    <p class="font-bold underline">Objetivo(s):</p>
                    @foreach ($commission->objetives as $objetive)
                        <p class="ml-16">{{ $loop->iteration }}-{{ $objetive->objetivo }}</p>
                    @endforeach
                </div>

                <div class="my-8">
                    <p class="font-bold underline">Personal :</p>
                    @foreach ($commission->users as $user)
                        <p class="ml-16">{{ $loop->iteration }}.- {{ $user->name }} {{ $user->apellido }}
                            <span class="font-bold">- {{ $user->cargo }}</span>
                        </p>
                    @endforeach
                </div>

                <div class="my-8">
                    @if ($commission->tipo === 'MANTENIMIENTO')
                        <p class="font-bold underline">Estaciones a visitar:</p>
                        @foreach ($commission->stations as $estation)
                            <p class="ml-16 uppercase">
                                {{ $estation->name }} {{ $estation->sistema }}:{{ $estation->tipo }} - {{ $estation->ubigeo->distrito }},
                                {{ $estation->ubigeo->provincia }}</p>
                        @endforeach
                    @else
                        <p class="font-bold underline">Lugares a visitar:</p>
                        @foreach ($commission->ubigeo as $ubigeo)
                            <p class="ml-16 uppercase">
                                {{ $loop->iteration }}.- {{ $ubigeo->distrito }} - {{ $ubigeo->provincia }}
                            </p>
                        @endforeach
                    @endif
                </div>

               
                <div class="my-8">
                    @if ($commission->tipo === 'MANTENIMIENTO')
                        <p class="font-bold underline">Equipos a trasaladar:</p>
                        <table class="table-auto m-auto w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-300 text-center text-white ">
                                    <th class="px-4 py-3">Nombre</th>
                                    <th class="px-4 py-3">Cod. Patrimonial</th>
                                    <th class="px-4 py-3">Modelo</th>
                                    <th class="px-4 py-3">Serie</th>
                                    <th class="px-4 py-3">Marca</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-center">
                                @forelse($commission->goods as $article)
                                    <tr>
                                        <td class="text-left font-bold">{{ $article->denominacion }}</td>
                                        <td class="">{{ $article->codPatrimonio }}</td>
                                        <td class="">{{ $article->modelo }}</td>
                                        <td class="">{{ $article->serie }}</td>
                                        <td class="">{{ $article->marca }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            ..:: Sin Registros ::..
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                    @endif
                </div>
            </div>


            <footer class="">
                <p class="text-xs"> Dirección de Comunicaciones Amazonas &copy; {{ date('Y') }} <br>
                    Direccion Regional de Transportes y Comunicaciones Amazonas</p>
            </footer>

        </body>

</html>
