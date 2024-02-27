<?php

namespace App\Http\Livewire\Commission;

use App\Models\Commission;
use App\Models\Objetive;
use Livewire\Component;
use Illuminate\Support\Str;

class Objectives extends Component
{
    public $commission;

    public $modalAdd = false;
    public $modalDel = false;

    public $objetive;

    public function mount(Commission $commission)
    {
        $this->commission = $commission;
    }

    public function addCommission()
    {
        $this->reset('commission', 'nameCommision', 'tipo', 'fechainicio', 'fechafin');
        $this->modalAdd = true;
    }

    protected $listeners = ['objAttach' => 'render',
                            'objDetach' => 'render',];


    protected $rules = [
        'objetive.name' => 'required',
    ];


    public function render()
    {
        return view('livewire.commission.objectives');
    }

    public function addObjective()
    {
        $this->reset('objetive');
        $this->modalAdd = true;
    }

    public function delObjetive($id)
    {
        $this->reset('objetive');
        $this->modalDel = $id;
    }

    public function saveObjetivo()
    {
        $this->validate();
        $name =  Str::upper($this->objetive['name']);
        if (isset($this->objetive->id)) {
            $this->objetive->name =  Str::upper($this->objetive->name);
            $this->objetive->save();
        } else {

            $this->commission->objetives()->create([
                'objetivo' => $name,
            ]);
        }
        $this->modalAdd = false;
        $this->emit('objAttach');
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }

    public function delete(Objetive $objetive)
    {
        $objetive->delete();
        $this->modalDel = false;
        $this->emit('objDetach');
    }

    public function edit(Objetive $objetive)
    {
        $this->objetive = $objetive;
        $this->modalAdd = true;
    }
}
