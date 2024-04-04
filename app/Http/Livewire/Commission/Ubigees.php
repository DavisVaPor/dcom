<?php

namespace App\Http\Livewire\Commission;

use App\Models\Commission;
use App\Models\Ubigeo;
use Livewire\Component;
use Livewire\WithPagination;

class Ubigees extends Component
{
    use WithPagination;
    public $commission;
    public $search = '';
    public $selected;
    public $ubigeo;

    public $modalAdd = false;
    public $modalDel = false;


    public function mount(Commission $commission)
    {
        $this->commission = $commission;
    }

    protected $listeners = [
        'ubigeeAttach' => 'render',
        'ubigeeDetach' => 'render',
    ];


    public function render()
    {
        $ubigees = Ubigeo::where('distrito', 'LIKE', '%' . $this->search . '%')
            ->where('id', 'LIKE', $this->ubigeo . '%')
            ->paginate(15);

        $ubigee = Commission::find($this->commission->id)
            ->ubigeo()
            ->get();


        return view('livewire.commission.ubigees',[
            'ubigees' => $ubigees,
            'ubigee' => $ubigee,
        ]);
    }

    public function addUbigeeCommission()
    {
        $this->reset('ubigeo');
        $this->reset('selected');
        $this->reset('search');
        $this->modalAdd = true;
    }

    public function addUbigee()
    {
        $this->commission->ubigeo()->attach($this->selected);
        $this->modalAdd = false;
        $this->emit('ubigeeAttach');

    }

    public function delUbigeo()
    {
        $this->commission->ubigeo()->detach($this->modalDel);
        $this->modalDel = false;
        $this->emit('userDetach');
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }
}
