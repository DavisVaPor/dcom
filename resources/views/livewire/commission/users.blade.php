<div>
    <div class="flex my-3 justify-between items-center border-b border-gray-300 border-3">
        <h1 class="mr-5 text-2xl font-bold text-blue-500">PERSONAL</h1>
        <div class="mr-4 my-2">
            @if ($commission->estado == 'PENDIENTE')
                <x-button wire:click="addUserCommission">
                    Añadir <x-icons.plus-circle class="ml-1"/>
                </x-button>
            @endif
        </div>
    </div>
    <table class="rounded-t-lg m-2 w-full mx-auto bg-gray-200 text-gray-800">
        <tr class="text-left border-b-2 border-gray-300">
            <th class="px-4 py-3 text-center">Nombre y Apellido</th>
            <th class="px-4 py-3 text-center">Email</th>
            <th class="px-4 py-3 text-center">Cargo</th>
            @if ($commission->estado == 'PENDIENTE')
                <th class="px-4 py-3"></th>
            @endif
        </tr>
        @forelse ($commission->users as $user)
            <tr class="bg-gray-100 border-b border-gray-200">
                <td class="px-4 py-3">{{ $user->name }}, {{ $user->apellido }}</td>
                <td class="px-4 py-3">{{ $user->email }}</td>
                <td class="px-4 py-3 text-center">{{ $user->cargo }}</td>
                @if ($commission->estado == 'PENDIENTE')
                    <td class="px-4 py-3">
                        <div class="flex justify-center">
                            <button wire:click="mostrarDel({{ $user->id }})"
                                class="text-red-500 hover:text-gray-600 cursor-pointer">
                                <x-icons.trash />
                            </button>
                        </div>
                    </td>
                @endif
            </tr>
        @empty
            <tr class="bg-gray-100 border-b border-gray-200">
                <td colspan="4" class="text-center">
                    No se encontraron registros
                </td>
            </tr>
        @endforelse
    </table>
    <div class="flex justify-end">
        <span class="text-xs text-left">
            Registros Seleccionados : {{$commission->users->count()}}
        </span>
    </div>



    {{-- Modal de Añadir --}}
    <x-dialog-modal wire:model="modalAdd">
        <x-slot name="title">
            <h1 class="font-bold uppercase">Añadir Personal</h1>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <div class="flex flex-col">
                    <div class="flex-grow overflow-auto">
                        <table class="text-sm rounded-t-lg m-5 w-full mx-auto bg-gray-200 text-gray-800">
                            <tr class="text-left border-b-2 border-gray-300">
                                <th class="px-4 py-3"></th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Cargo</th>
                            </tr>
                            @foreach ($users as $user)
                                @if (!$commission->users->contains($user->id))
                                    <tr class="bg-gray-100 border-b border-gray-200">
                                        <td class="px-4 py-2">
                                            <input wire:model='selectedUser' value="{{ $user->id }}" type="radio">
                                        </td>
                                        <td class="text-sm px-4 py-2 uppercase">{{ $user->name }},
                                            {{ $user->apellido }}</td>
                                        <td class="text-sm px-4 py-2">{{ $user->cargo }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="addUser({{ $selectedUser }})" wire:loading.attr="disabled">
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
            {{ __('¿Seguro que desea quitar al personal de la comision?') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalDel',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="delEstacion({{ $modalDel }})" wire:loading.attr="disabled">
                {{ __('Si') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
