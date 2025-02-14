<div class="mt-4">
    <div class="flex justify-between items-center">
        <div>  
            <x-button wire:click="regresar">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-circle-left"
                    class="svg-inline--fa fa-chevron-circle-left fa-w-16 w-4 h-4" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zM142.1 273l135.5 135.5c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L226.9 256l101.6-101.6c9.4-9.4 9.4-24.6 0-33.9l-17-17c-9.4-9.4-24.6-9.4-33.9 0L142.1 239c-9.4 9.4-9.4 24.6 0 34z">
                    </path>
                </svg>
                <p class="text-xs ml-2">Regresar</p>
            </x-button>
        </div>  
        @foreach ($this->report->commission->goods as $item)
            {{$item->pivot}}
        @endforeach

        <div class="flex justify-center mt-2">
            <div>
                @if ($report->estado == 'BORRADOR')
                    <x-button wire:click="mostrarPre({{ $report->id }})" class="bg-green-500">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                            class="svg-inline--fa fa-check fa-w-16 h-4 w-4 mr-2" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                            </path>
                        </svg>
                        <p class="text-xs">Presentar</p>
                    </x-button>
                @else
                    @if ($report->estado == 'PRESENTADO')
                        <x-button wire:click="mostrarPen({{ $report->id }})" class="bg-yellow-700">
                            <p class="font-bold text-xs">Pendiente</p>
                        </x-button>

                        @if (Auth::user()->rol->name == 'Director(a)')
                            <x-button wire:click="mostrarRev({{ $report->id }})" class="bg-blue-700">
                            <p class="font-bold text-xs">Aprobar</p>
                        </x-button>
                        @endif
                    @endif
                @endif
            </div>
            <x-button onclick="location.reload()" class="bg-blue-500 ml-2">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="redo" 
                class="svg-inline--fa fa-redo fa-w-16 h-4 w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M500.33 0h-47.41a12 12 0 0 0-12 12.57l4 82.76A247.42 247.42 0 0 0 256 8C119.34 8 7.9 119.53 8 256.19 8.1 393.07 119.1 504 256 504a247.1 247.1 0 0 0 166.18-63.91 12 12 0 0 0 .48-17.43l-34-34a12 12 0 0 0-16.38-.55A176 176 0 1 1 402.1 157.8l-101.53-4.87a12 12 0 0 0-12.57 12v47.41a12 12 0 0 0 12 12h200.33a12 12 0 0 0 12-12V12a12 12 0 0 0-12-12z">
                    </path>
                </svg>
            </x-button>
        </div>
    </div>

    {{-- Modal de Presentar --}}
    <x-dialog-modal wire:model="modalPre">
        <x-slot name="title">
            <h1 class="font-bold uppercase">{{ __('Presentar informe') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea presentar el informe?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalPre',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="Presentar()" onclick="location.reload()"
                wire:loading.attr="disabled">
                {{ __('Presentar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Borrador --}}
    <x-dialog-modal wire:model="modalPen">
        <x-slot name="title">
            <h1 class="font-bold">{{ __('Pendiente') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea volver a borrador el informe?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalPre',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="Borrador()" onclick="location.reload()" wire:loading.attr="disabled">
                {{ __('Si') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Revisado --}}
    <x-dialog-modal wire:model="modalRev">
        <x-slot name="title">
            <h1 class="font-bold uppercase">{{ __('Visto bueno al Informe') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea aprobar el informe?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalRev',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="Revisar()" onclick="location.reload()" wire:loading.attr="disabled">
                {{ __('Si') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
