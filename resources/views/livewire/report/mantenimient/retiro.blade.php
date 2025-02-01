<div>
    <button wire:click='openModal()' class="text-red-500 hover:text-red-900 cursor-pointer">
        <abbr title="Retirar el Equipo">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M15.707 4.293a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 011.414-1.414L10 8.586l4.293-4.293a1 1 0 011.414 0zm0 6a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L10 14.586l4.293-4.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
        </abbr>
    </button>

    {{-- Modal de Retrio de Bien --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Registro de Retiro de Equipo</h1>
        </x-slot>

        <x-slot name="content">
            <div class="m-2 flex justify-end items-center">
                <x-label class="text-base uppercase mr-2 font-bold border-gray-200" for="fecha"
                    value="{{ __('Fecha de Retiro') }}" />
                <input class="rounded-xl text-sm" type="date" name="fecha" id="fecha" max="{{$fechaActual}}" wire:model='fecha'>
                <x-input-error for="fecha" class="mt-2" />
            </div>
            <x-label class="text-base font-bold border-gray-200 uppercase" for="ArticleSelect"
                value="{{ __('Equipo A hacer Retirado') }}" />
            <nav class="text-base">
                {{ $article->denominacion }}
                <li>Codigo Patrimonial: {{ $article->codPatrimonio }}</li>
                <li> Marca: {{ $article->marca }}</li>
                <li>Modelo: {{ $article->modelo }}</li>
                <li>Serie: {{ $article->serie }}</li>
                <li>Estado: {{ $article->estado }}</li>
                <li>Operativo: {{ $article->operatividad }}</li>
            </nav>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="retiro()" wire:loading.attr="disabled">
                {{ __('Retirar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
