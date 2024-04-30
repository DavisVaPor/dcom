<div>
    <div class="flex my-3 justify-between items-center border-b border-gray-300 border-3">
        <h1 class="mr-5 text-2xl font-bold text-blue-500">EQUIPOS A TRASLADAR</h1>
        @if ($commission->estado == 'PENDIENTE')
            <div class="justify-end mr-4 my-2">
                <x-button wire:click="addModal">
                    Añadir <x-icons.plus-circle class="ml-1" />
                </x-button>
            </div>
        @endif
    </div>
    <div class="justify-content-between">
        <table class="rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
            <tr class="text-left">
                <th class="px-4 py-3">Cod. Patrimonial</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Modelo</th>
                <th class="px-4 py-3">Serie</th>
                <th class="px-4 py-3">Estado</th>
                <th class="px-4 py-3"></th>
            </tr>
            @forelse ($commission->goods as $article)
                <tr class="bg-gray-100 border-b border-gray-200">
                    <td class="px-4 py-3">
                        @if ($article->codPatrimonial)
                            {{ $article->codPatrimonial }}
                        @else
                            Sin Codigo
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $article->denominacion }}</td>
                    <td class="px-4 py-3">{{ $article->modelo }}</td>
                    <td class="px-4 py-3">{{ $article->serie }}</td>
                    <td class="px-4 py-3">{{ $article->condicion }}</td>
                    <td class="px-4 py-3">
                        @if ($commission->estado == 'PENDIENTE')
                            <div class="text-center">
                                <button wire:click="mostrarDel({{ $article->id }})"
                                    class="text-red-500 hover:text-gray-900 cursor-pointer">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="minus-circle"
                                        class="svg-inline--fa fa-minus-circle fa-w-16 w-6 h-6" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zM124 296c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h264c6.6 0 12 5.4 12 12v56c0 6.6-5.4 12-12 12H124z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr class="bg-gray-100 border-b border-gray-200">
                    <td colspan="6" class="text-center">
                        No se encontraron registros
                    </td>
                </tr>
            @endforelse
        </table>

        <div class="flex justify-end">
            <span class="text-xs text-left">
                Registros Seleccionados : {{$commission->goods->count()}}
            </span>
        </div>
    </div>

    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold">Añadir Bien a la Comision de Servicio</h1>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <div class="flex ">
                    <input wire:model='search' class="form-control m-auto rounded-xl w-1/2 mx-2" type="search"
                        placeholder="Búsqueda por Nombre" aria-label="Search">
                    <input wire:model='searchserie' class="form-control m-auto rounded-xl w-1/2 mx-2" type="search"
                        placeholder="Búsqueda por Serie" aria-label="Search">
                </div>

                <div class="flex flex-col">
                    <div class="flex-grow overflow-auto">
                        <table class="rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
                            <tr class="text-center border-b-2 border-gray-300">
                                <th class=""></th>
                                <th class="px-4 py-3">Cod. Pat. </th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Modelo</th>
                                <th class="px-4 py-3">Serie</th>
                                <th class="px-4 py-3">Estado</th>
                            </tr>
                            @foreach ($articles as $article)
                                @if (!$commission->goods->contains($article->id))
                                    <tr class="bg-gray-100 border-b border-gray-200 text-sm">
                                        <td class="">
                                            <input class="rounded-2xl ml-2" wire:model='selectedArticle'
                                                value="{{ $article->id }}" type="radio">
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($article->codPatrimonial)
                                                {{ $article->codPatrimonial }}
                                            @else
                                                Sin Codigo
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">{{ $article->denominacion }}</td>
                                        <td class="px-4 py-3">{{ $article->modelo }}</td>
                                        <td class="px-4 py-3 text-xs">{{ $article->serie }}</td>
                                        <td class="px-4 py-3">{{ $article->condicion }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="addArticle()" wire:loading.attr="disabled">
                {{ __('Añadir') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold">{{ __('') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea quitar el Equipo?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="delArticle({{ $modalDel }})" wire:loading.attr="disabled">
                {{ __('Si') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
