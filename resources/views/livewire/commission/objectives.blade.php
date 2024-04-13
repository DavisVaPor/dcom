<div>
    <div class="flex my-3 justify-between items-center border-b border-gray-300 border-3">
        <h1 class="mr-5 text-2xl font-bold text-blue-500">OBJETIVOS</h1>
        <div class="mr-4 my-2">
            @if ($commission->estado == 'PENDIENTE')
                <x-button wire:click="addObjective">
                    Añadir <x-icons.plus-circle class="ml-1" />
                </x-button>
            @endif
        </div>
    </div>


    @if ($commission->objetives->isNotEmpty())
        <table class="rounded-t-lg m-5 w-full mx-auto bg-gray-200 text-gray-800">
            <tr class="text-left border-b-2 border-gray-300">
                <th class="px-4 py-1">Descripción</th>
                @if ($commission->estado == 'PENDIENTE')
                    <th class="px-4 py-3 text-right"></th>
                @endif
            </tr>
            @foreach ($commission->objetives as $objetive)
                <tr class="bg-gray-100 border-b border-gray-200">
                    <td class="w-11/12 px-4 py-3">
                        <li>
                            <a  class="cursor-pointer hover:text-blue-600" wire:click="edit({{ $objetive->id }})">
                                {{ $objetive->objetivo }}
                            </a>
                        </li>
                    </td>
                    @if ($commission->estado == 'PENDIENTE')
                        <td class="px-4 py-1 w-1/12">
                            <div class="text-center">
                                <button class="text-red-500 hover:text-gray-600 cursor-pointer"
                                    wire:click="mostrarDel({{ $objetive->id }})" wire:loading.attr="disabled">
                                    <x-icons.trash />
                                </button>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    @else
        <div class="text-center">
            <p class="font-bold text-gray-600">.:: SIN REGISTRO ::.</p>
        </div>
    @endif

    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Añadir Objetivo</h1>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label class="text-base font-bold border-gray-200" for="name"
                    value="{{ __('Descripcion del objetivo') }}" />
                    <textarea id="name"  wire:model.defer='objetive.name' class="resize-none w-full h-1/5 border rounded-md">

                    </textarea>
                <x-input-error for="objetive.name" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="saveObjetivo()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Modal de Eliminar --}}
    <x-dialog-modal wire:model="modalDel">
        <x-slot name="title">
            <h1 class="font-bold">{{ __('Eliminar Objetivo') }}</h1>
        </x-slot>

        <x-slot name="content">
            {{ __('¿Seguro que desea eliminar?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="delete({{ $modalDel }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
