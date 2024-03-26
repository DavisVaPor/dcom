<?php

namespace App\Http\Livewire\Commission;

use App\Models\Commission;
use App\Models\Station;
use Livewire\Component;
use Livewire\WithPagination;

class Stations extends Component
{
    public $commission;
    use WithPagination;

    public $searchEstation = '';
    public $ubigeo = '';
    public $selectedEstation;

    public $modalAdd = false;
    public $modalDel = false;

    public function mount(Commission $commission)
    {
        $this->commission = $commission;
    }

    protected $listeners = [
        'estationAttach' => 'render',
        'estationDetach' => 'render',
    ];

    public function updatingsearchEstation()
    {
        $this->resetPage();
    }

    public function render()
    {
        $estations = Station::where('name', 'LIKE', $this->searchEstation . '%')
            ->where('ubigeo_id', 'LIKE', $this->ubigeo . '%')
            ->orderBy('name', 'asc')
            ->paginate(15);

        return view('livewire.commission.stations', [
            'estations' => $estations,
        ]);
    }

    public function addStationCommission()
    {
        $this->reset('searchEstation');
        $this->modalAdd = true;
    }

    public function addStation()
    {
        $this->commission->stations()->attach($this->selectedEstation);
        $this->modalAdd = false;

        $this->emit('estationAttach');
    }

    public function delEstacion()
    {
        $this->commission->stations()->detach($this->modalDel);
        
        //$estation->commissions()->detach($this->commission->id);
        $this->modalDel = false;
        $this->emit('estationDetach');
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }
}
