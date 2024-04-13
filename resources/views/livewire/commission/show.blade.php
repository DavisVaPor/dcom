<div class="flex justify-between items-center">
    <div>
        @if ($commission->estado == 'PENDIENTE')
            <x-button wire:click="mostarConf({{ $commission->id }})" class="bg-green-800">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                    class="svg-inline--fa fa-check fa-w-16 h-4 w-4 mr-1" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z">
                    </path>
                </svg>
                <p class="text-xs">Confirmar</p>
            </x-button>
        @else
            @isset($commission->reports)
                @if ($commission->estado == 'CONFIRMADO')
                    <x-button wire:click="mostrarPen({{ $commission->id }})" class="bg-yellow-700">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pause"
                            class="h-4 w-4 mr-1 svg-inline--fa fa-pause fa-w-14" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M144 479H48c-26.5 0-48-21.5-48-48V79c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zm304-48V79c0-26.5-21.5-48-48-48h-96c-26.5 0-48 21.5-48 48v352c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48z">
                            </path>
                        </svg>
                        <p class="font-bold text-xs">Pendiente</p>
                    </x-button>
                @endif
            @endisset
        @endif
    </div>

    {{-- Modal de Confirmar --}}
    <x-dialog-modal wire:model="modalConf">
        <x-slot name="title">
            <h1 class="font-bold ">{{ __('AVISO') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Desea confirmar la comision de servicio?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalConf',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="Confirmar()" wire:loading.attr="disabled">
                {{ __('Confirmar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Pendiente --}}
    <x-dialog-modal wire:model="modalPen">
        <x-slot name="title">
            <h1 class="font-bold ">{{ __('Aviso') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Dejar en pendiente la comision de servicio?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalPen',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="Pendiente()" wire:loading.attr="disabled">
                {{ __('Si') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Anulacion --}}
    <x-dialog-modal wire:model="modalAnu">
        <x-slot name="title">
            <h1 class="font-bold ">{{ __('Aviso') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Desar Anular la comision de servicio?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAnu',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="Anular()" wire:loading.attr="disabled">
                {{ __('Anular') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
