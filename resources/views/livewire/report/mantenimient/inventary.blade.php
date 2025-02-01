<div>
    <p class="text-center text-green-600 text-lg font-bold">
        INVENTARIO DE LOS EQUIPOS DE TELECOMUNICACION DE LA ESTACION
    </p>

    <div class="flex justify-end">
        @livewire('report.mantenimient.install', ['estation' => $estation, 'informe' => $informe], key($estation->estation))   
        {{-- @livewire('report.article.retirototal', ['estation' => $estation,'informe' => $informe],key($estation->id)) --}}
    </div>

    <div class="flex justify-between ml-2 mt-2">
        <input wire:model='search' class="form-control w-full rounded-xl" type="search"
            placeholder="Búsqueda de Bienes" aria-label="Search">
        <select class="rounded-xl mx-2 text-sm" name="sistema" id="sistema" wire:model='sistema'>
            <option value="">Todos</option>
            @foreach ($systems as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <table class="text-sm rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
        <tr class="border-b-2 border-gray-300">
            <th class="px-4 py-3">Cod. Pat. DRTC</th>
            <th class="px-4 py-3">Nombre del Equipo</th>
            <th class="px-4 py-3">Serie</th>
            <th class="px-4 py-3 text-center">Sistema</th>
            <th class="px-4 py-3 text-center">Estado</th>
            <th class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                    </path>
                </svg>
            </th>
        </tr>
        @forelse ($articles as $article)
            <tr class="bg-gray-100 border-b border-gray-200">
                <td class="px-4 font-bold ">{{ $article->codPatrimonio }}</td>
                <td class="px-4 py-1">{{ $article->denominacion }}</td>
                <td class="px-4 py-1">{{ $article->serie }}</td>
                <td class="px-4 py-1 text-center">{{ $article->system->name }}</td>
                <td class="px-4 py-1 text-center font-bold">
                    @if ($article->condicion == 'BUENO')
                        <p class="text-green-500">
                            {{ $article->condicion }}
                        </p>
                    @else
                        @if ($article->condicion == 'REGULAR')
                            <p class="text-yellow-500">
                                {{ $article->condicion }}
                            </p>
                        @else
                            <p class="text-red-500">
                                {{ $article->condicion }}
                            </p>
                        @endif
                    @endif
                </td>
                <td class="">
                    <div class="flex justify-center">
                        {{-- @livewire('report.article.reparations', ['article' => $article, 'estation' => $estation, 'informe' => $informe], key($article->id))

                        @livewire('report.article.retiro', ['article' => $article, 'estation' => $estation, 'informe' => $informe], key($article->id)) --}}

                        @livewire('report.mantenimient.retiro', ['estation' => $estation, 'informe' => $informe, 'article' => $article], key($estation->estation))
                    </div>
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
    {{ $articles->links() }}
</div>
