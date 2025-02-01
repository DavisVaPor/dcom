<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Observation;
use App\Models\ServiceMantenimient;
use App\Models\Station;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Observations extends Component
{

    public $informe;
    public $estation;
    public $observation, $servicemantenimiento;

    public $modalAdd = false;
    public $modalDel = false;


    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }

    protected $listeners = [
        'observationAdd' => 'render',
        'observationSup' => 'render',
        'SiensterAdd' => 'render'
    ];

    protected $rules = [
        'observation.description' => 'required|min:30',
        'observation.nivel' => 'required',
    ];

    public function render()
    {
        $this->servicemantenimiento = ServiceMantenimient::where('station_id', $this->estation->id)->where('report_id',$this->informe->id)->first(); 
        
        return view('livewire.report.mantenimient.observations');
    }

    public function addModal()
    {
        $this->reset('observation');
        $this->modalAdd = true;
    }

    public function saveObservation()
    {
        $this->validate();
        if (isset($this->observation->id)) {
            $this->observation->save();
        } else {
            $this->servicemantenimiento->observations()->create([
                'description' => $this->observation['description'],
                'nivel' => $this->observation['nivel'],
            ]);
        }
        $this->modalAdd = false;
        $this->emit('observationAdd');
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }

    public function deleteObservation(Observation $observation)
    {
        $observation->delete();
        $this->modalDel = false;
        $this->emit('observationSup');
    }
    
    public function editObservation(Observation $observation)
    {
        $this->observation = $observation;
        $this->modalAdd = true;
    }
}
