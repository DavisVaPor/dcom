<div>
    <div class="flex my-3 w-full">
        <input wire:model='search' class="form-control rounded-lg mr-sm-2 w-5/6 px-2 " type="search" placeholder="Búsqueda"
            aria-label="Search">
        <div class="">
            <select class="rounded-lg mx-2" wire:model='estation' name="" id="">
                <option selected value="">Todos</option>
                @if ($stations)
                    @foreach ($stations as $station)
                        <option value="{{ $station->id }}">{{ $station->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="justify-end mr-auto">
            <x-button wire:click="add" class="bg-green-500">
                Añadir
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

    <div class="table w-full p-1">
        <table class="w-full border ">
            <thead class="">
                <tr class="bg-gray-50 border-b rounded-lg">
                    <th class="py-2 border-r cursor-pointer text-sm font-bold text-gray-500">
                        <div class="flex items-center justify-center">
                            Cod. Patr.
                        </div>
                    </th>
                    <th class="py-2 border-r cursor-pointer text-sm font-bold text-gray-500">
                        <div class="flex items-center justify-center">
                            Denominacion
                        </div>
                    </th>
                    <th class="py-2 border-r cursor-pointer text-sm font-bold text-gray-500">
                        <div class="flex items-center justify-center">
                            Categoria
                        </div>
                    </th>
                    <th class="py-2 border-r cursor-pointer text-sm font-bold text-gray-500">
                        <div class="flex items-center justify-center">
                            Modelo
                        </div>
                    </th>
                    <th class="py-2 border-r cursor-pointer text-sm font-bold text-gray-500">
                        <div class="flex items-center justify-center">
                            Condicion
                        </div>
                    </th>
                    <th class="py-2 border-r cursor-pointer text-sm font-bold text-gray-500">
                        <div class="flex items-center justify-center">
                            Serie
                        </div>
                    </th>
                    <th class="py-2 border-r cursor-pointer text-sm font-bold text-gray-500">
                        <div class="flex items-center justify-center">
                            Ubicacion
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($goods as $article)
                    <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                        <td class="py-2 border-r uppercase text-left pl-3">
                            <a href="{{ route('equipo.show', [$article]) }}">
                                {{ $article->codPatrimonio }}
                            </a>
                        </td>
                        <td class="py-2 border-r uppercase text-left pl-3">
                            <a href="{{ route('equipo.show', [$article]) }}">
                                {{ $article->denominacion }}
                            </a>
                        </td>
                        <td class="py-2 border-r text-xs">{{ Str::limit($article->category->name, 15, '...') }}</td>
                        <td class="py-2 border-r uppercase">{{ $article->modelo }}</td>
                        <td class="py-2 border-r uppercase">{{ $article->condicion }}</td>
                        <td class="py-2 border-r">
                            @if ($article->serie)
                                {{ $article->serie }}
                            @else
                                SIN SERIE
                            @endif
                        </td>
                        <td class="py-2 border-r">
                            @if ($article->estation)
                                <a href="{{ route('estacion.show', $article->estation->id) }}">
                                    {{ $article->estation->name }}
                                </a>
                            @else
                                DRTC
                            @endif
                        </td>
                    </tr>
                @empty
                    <td colspan="6" class="py-2 border-r text-center"> ..:: No se encontraron registros ::..</td>
                @endforelse
            </tbody>
        </table>
        <p class="text-sm text-right mt-2">Total de Registros Consultados: {{ $goods->count() }}</p>
    </div>

    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold text-center uppercase">Ingreso de Equipo a Almacen</h1>
        </x-slot>

        <x-slot name="content">
            <div class="flex justify-between items-center col-span-6 sm:col-span-4 mb-2">
                <div>
                    <x-label class="text-base mr-2 font-bold border-gray-200" for="codPatrimonial"
                        value="{{ __('Cod. Patrimonial') }}" />
                    <x-input type="number" class="text-sm block w-auto font-semibold text-right"
                        wire:model='codPatrimonial' maxlength="12" />
                </div>
                <div>
                    <x-label class="text-base font-bold border-gray-200" for="tipo" value="{{ __('Tipo') }}" />
                    <select class="rounded-lg text-sm font-semibold" wire:model='tipo'>
                        <option value="" selected></option>
                        <option value="SUMINISTRO">SUMINISTRO</option>
                        <option value="ACTIVO">EQUIPO</option>
                    </select>
                </div>

                @if ($tipo == 'SUMINISTRO')
                    <div>
                        <x-label class="text-base mr-2 font-bold border-gray-200" for="cantidad"
                            value="{{ __('Cantidad') }}" />
                        <x-input id="cantidad" type="number" class="text-sm block w-auto font-semibold text-right"
                            wire:model='cantidad' maxlength="12" size='12' />
                    </div>
                @endif
            </div>
            <x-input-error for="article.tipo" class="mt-2" />
            <x-input-error for="article.codPatrimonial" class="mt-1" />

            <div class="col-span-6 sm:col-span-4">
                <x-label class="text-base font-bold border-gray-200" for="denominacion"
                    value="{{ __('Denominación') }}" />
                <x-input id="name" type="text" class="text-sm block w-full font-semibold"
                    wire:model.defer='article.denominacion' />
                <x-input-error for="article.denominacion" class="mt-1" />
            </div>

            <div class="flex mt-2 justify-between">
                <div class="col-span-6 sm:col-span-4">
                    <x-label class="text-base font-bold border-gray-200" for="marca"
                        value="{{ __('Marca') }}" />
                    <x-input id="name" type="text" class="text-sm block w-full font-semibold"
                        wire:model.defer='article.marca' />
                    <x-input-error for="article.marca" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label class="text-base font-bold border-gray-200" for="modelo"
                        value="{{ __('Modelo') }}" />
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
                @if ($tipo == 'ACTIVO')
                    <div class="w-full">
                        <x-label class="text-base font-bold border-gray-200" for="nserie"
                            value="{{ __('Numero de Serie') }}" />
                        <x-input id="name" type="text" class="text-sm  block w-full font-semibold"
                            wire:model.defer='article.nserie' />
                        <x-input-error for="article.nserie" class="mt-2" />
                    </div>
                @endif
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
