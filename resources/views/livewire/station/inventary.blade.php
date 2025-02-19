<div>
    <div class="flex justify-between my-2 items-center">
        <input wire:model='search' class="form-control rounded-lg mr-sm-2 w-full m-auto mx-2" type="search"
            placeholder="Búsqueda del Articulo" aria-label="Search">

        <select class="rounded-lg mx-2" wire:model="system" name="" id="">
            <option selected value="">Sistemas</option>
            <option value="1">SISTEMA DE TORRE</option>
            <option value="2">SISTEMA DE RECPECION</option>
            <option value="3">SISTEMA DE TRANSMISION TV</option>
            <option value="4">SISTEMA DE TRANSMISION FM</option>
            <option value="5">SISTEMA DE PROTECCION</option>
            <option value="6">SISTEMA DE FOTOVOLTAICO</option>
        </select>
        <div class="justify-end mr-auto">
            <x-button wire:click="modalOpen" class="bg-green-500">
                Actualizar
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
    @isset($articles)
        <table class="table-auto text-sm rounded-t-lg m-5 w-full mx-auto bg-gray-200 text-gray-800">
            <tr class="text-center border-b-2 border-gray-300">
                <th class="px-4 py-3">Cod Patrimonial</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Marca</th>
                <th class="px-4 py-3">Modelo</th>
                <th class="px-4 py-3">Serie</th>
                <th class="px-4 py-3">Operatividad</th>
                <th class="px-4 py-3">Estado</th>
                <th class="px-4 py-3">Sistema</th>
            </tr>
            @forelse ($articles as $article)
                <tr class="bg-gray-100 border-b text-xs border-gray-200 hover:bg-blue-200 text-center">
                    <td class="px-4 py-2">
                        {{ $article->codPatrimonio }}
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('equipo.show', $article->id) }}" target="_blank"
                            class="text-sm text-gray-900 block uppercase hover:text-blue-500">
                            {{ $article->denominacion }}
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        {{ $article->marca }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $article->modelo }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $article->serie }}
                    </td>
                    <td class="px-4 py-2 font-bold">
                        @if ($article->operatividad == 'OPERATIVO')
                            <p class="text-green-500">
                                {{ $article->operatividad }}
                            </p>
                        @else
                            <p class="text-red-500">
                                {{ $article->operatividad }}
                            </p>
                        @endif
                    </td>
                    <td class="px-4 py-2 font-bold">
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
                    <td class="px-4 py-2">
                        {{ $article->system->name }}
                    </td>
                </tr>
            @empty
                <tr class="bg-gray-100 border-b border-gray-200">
                    <td colspan="8" class="text-center px-4 py-2 font-bold text-gray-600">No hay registros</td>
                </tr>
            @endforelse
        </table>
    @endisset

    {{-- modal de actualizar invemtario de estacion --}}
    <x-dialog-modal wire:model="modalOpen">
        <x-slot name="title">
            <h1 class="text-sm font-bold uppercase">Agregar Equipo a la Estación de {{ $estation->name }}
                {{ $estation->sistema }}:{{ $estation->tipo }}</h1>
        </x-slot>

        <x-slot name="content">
            <div class="flex justify-between items-center col-span-6 sm:col-span-4 mb-2">
                <div>
                    <x-label class="text-base mr-2 font-bold border-gray-200" for="codPatrimonial"
                        value="{{ __('Cod. Patrimonial') }}" />
                    <input type="number" maxlength="12" wire:model='codPatrimonial'>
                    <x-input-error for="codPatrimonial" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label class="text-base font-bold border-gray-200" for="denominacion"
                    value="{{ __('Denominación') }}" />
                <x-input id="name" type="text" class="text-sm block w-full font-semibold"
                    wire:model.defer='article.denominacion' />
                <x-input-error for="article.denominacion" class="mt-1" />
            </div>

            <div class="flex mt-2 justify-between">
                <div class="col-span-6 sm:col-span-4">
                    <x-label class="text-base font-bold border-gray-200" for="marca" value="{{ __('Marca') }}" />
                    <x-input id="name" type="text" class="text-sm block w-full font-semibold"
                        wire:model.defer='article.marca' />
                    <x-input-error for="article.marca" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label class="text-base font-bold border-gray-200" for="modelo" value="{{ __('Modelo') }}" />
                    <x-input id="name" type="text" class="text-sm block w-full font-semibold"
                        wire:model.defer='article.modelo' />
                    <x-input-error for="article.modelo" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label class="text-base font-bold border-gray-200" for="color"
                        value="{{ __('Color') }}" />
                    <x-input id="name" type="text" class="text-sm block w-full font-semibold"
                        wire:model.defer='article.color' />
                    <x-input-error for="article.color" class="mt-2" />
                </div>

            </div>
            <div class="flex justify-between mt-2">
                <div class="w-1/3 col-span-6 sm:col-span-4">
                    <x-label class="text-base font-bold border-gray-200" for="Condicion"
                        value="{{ __('Condicion') }}" />
                    <select class="rounded-lg text-sm w-full font-semibold" wire:model.defer='article.condicion'>
                        <option value="" selected></option>
                        <option value="BUENO">BUENO</option>
                        <option value="REGULAR">REGULAR</option>
                        <option value="MALO">MALO</option>
                    </select>
                    <x-input-error for="article.condicion" class="mt-2" />
                </div>

                <div class="w-1/3 mx-2 col-span-6 sm:col-span-4">
                    <x-label class="text-base font-bold border-gray-200" for="Operatividad"
                        value="{{ __('Operatividad') }}" />
                    <select class="rounded-lg text-sm w-full font-semibold" wire:model.defer='article.operatividad'>
                        <option value="" selected></option>
                        <option value="OPERATIVO">OPERATIVO</option>
                        <option value="INOPERATIVO">INOPERATIVO</option>
                    </select>
                    <x-input-error for="article.operatividad" class="mt-2" />
                </div>

                <div class="w-1/3 col-span-6 sm:col-span-4">
                    <x-label class="text-base font-bold border-gray-200" for="situacion"
                        value="{{ __('Situacion') }}" />
                    <select class="rounded-lg text-sm w-full font-semibold" wire:model.defer='article.situacion'>
                        <option value="" selected></option>
                        <option value="USO">USO</option>
                        <option value="DESUSO">DESUSO</option>
                    </select>
                    <x-input-error for="article.situacion" class="mt-2" />
                </div>
            </div>
            <div class="flex mt-2">
                <x-label class="text-base font-bold border-gray-200" for="nserie"
                    value="{{ __('Numero de Serie') }}" />
                <x-input id="name" type="text" class="text-sm  block w-full font-semibold"
                    wire:model.defer='article.nserie' />
                <x-input-error for="article.nserie" class="mt-2" />
            </div>

            <div class="mt-2 col-span-6 sm:col-span-4">
                <div class="mt-2">
                    <x-label class="text-base font-bold border-gray-200" for="category_id"
                        value="{{ __('Categoria') }}" />
                    <select class="rounded-lg text-xs" wire:model='article.category_id'>
                        <option value="">Catergorias de Bienes</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="article.category_id" class="mt-2" />
                </div>
                <div class="mt-2">
                    <x-label class="text-base font-bold border-gray-200" for="category_id"
                        value="{{ __('Sistema') }}" />
                    <select class="rounded-lg text-xs" wire:model='article.system_id'>
                        <option value="">Sistema</option>
                        @foreach ($systems as $system)
                            <option value="{{ $system->id }}">{{ $system->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="article.system_id" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="saveArticle()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
