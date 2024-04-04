<?php

namespace App\Http\Livewire\Commission;

use App\Models\Commission;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $commission;
    public $selectedUser;

    public $modalAdd = false;
    public $modalDel = false;

    protected $listeners = [
        'userAttach' => 'render',
        'userDetach' => 'render',
    ];

    public function mount(Commission $commission)
    {
        $this->commission = $commission;
    }

    public function render()
    {
        $users = User::all();

        return view('livewire.commission.users',[
            'users' => $users,
        ]);
    }

    public function addUserCommission()
    {
        $this->modalAdd = true;
    }

    public function addUser()
    {
        $this->commission->users()->attach($this->selectedUser);
        $this->modalAdd = false;
        $this->emit('userAttach');
    }
    
    public function delEstacion()
    {
        $this->commission->users()->detach($this->modalDel);
        $this->modalDel = false;
        $this->emit('userDetach');
    } 

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }
}
