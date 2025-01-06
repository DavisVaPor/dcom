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
</head>

<body>
    <div class="flex justify-between">
        <div style="float: right; font-size: 12px;">
            <p>Fecha : {{ date('j-m-Y') }}</p>
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

            <p class="text-center text-2xl font-bold mt-6">
                PAPELETA DE {{ $ballot->tipo }} - {{ $ballot->numero }} - DCOM
            </p>

            <p class="underline">
                Datos de la Comision de Servicio
            </p>

            <h2>
                <span>{{$ballot->commission->comision}}</span>
            </h2>

            <h2>
                Tipo: {{$ballot->commission->tipo}}
            </h2>

            <h3>
                Fecha de Incio : {{$ballot->commission->fecha_inicio}}
            </h3>
            <h3>
                Fecha de Fin : {{$ballot->commission->fecha_fin}}
            </h3>
            <table class="rounded-t-lg mt-6 w-full bg-gray-500 text-gray-800">
                <thead class="text-sm">
                    <tr class="border-b-2 border-gray-500 text-center">
                        <th>Cod. Patromonial</th>
                        <th>Denominacion</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Serie</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @foreach ($ballot->goods as $good)
                        <tr class="border-b-2 border-gray-500 text-center">
                            <td>{{ $good->codPatrimonio }}</td>
                            <td>{{ $good->denominacion }}</td>
                            <td>{{ $good->marca }}</td>
                            <td>{{ $good->modelo }}</td>
                            <td>{{ $good->serie }}</td>
                            <td>{{ $good->condicion }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <p class="text-sm float-end mt-4">Registros: <span class="font-bold">{{$ballot->count()}}</span></p>

            <footer class="">
                <p class="text-xs"> Dirección de Comunicaciones Amazonas &copy; {{ date('Y') }} <br>
                    Direccion Regional de Transportes y Comunicaciones Amazonas</p>
            </footer>

        </body>

</html>
