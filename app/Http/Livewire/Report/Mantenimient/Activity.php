<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Activity as ModelsActivity;
use App\Models\Station;
use App\Models\ServiceMantenimient;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Activity extends Component
{
    public $informe;
    public $estation;
    public $actividad;
    public $mantenimient;
    public $mantenimiento = 'DIAGNOSTICO';
    public $servicio, $description;
    public $servicemantenimiento, $fechaActual;

    public $estadoEstacion;

    public $modalAdd = false, $modalAddActivity = false;
    public $modalDel = false, $modalDelActivity = false;

    protected $rules = [
        'mantenimiento' => 'required',
        'mantenimient.fechaServicio' => 'required',
        'mantenimient.diagnostico' => 'required',
        'mantenimient.acciones' => 'required',
    ];

    protected $listeners = [
        'mantenimientAdd' => 'render',
        'mantenimientSup' => 'render',
        'activityAdd' => 'render',
    ];

    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }

    public function render()
    {
        $this->fechaActual = date('Y-m-d');

        $this->servicemantenimiento = ServiceMantenimient::where('station_id', $this->estation->id)->where('report_id',$this->informe->id)->first(); 
        
        return view('livewire.report.mantenimient.activity',[
            
        ]);
    }

    public function addModal()
    {
        $this->reset('mantenimient');
        $this->modalAdd = true;
    }
    
    public function saveMantenimiento()
    {
        $this->validate();
            $this->informe->servicemantenimiento()->create([
                'servicio' => $this->mantenimiento,
                'station_id' => $this->estation->id,
                'diagnostico' => $this->mantenimient['diagnostico'],
                'fechaServicio' => $this->mantenimient['fechaServicio'],
                'acciones' => $this->mantenimient['acciones'],
            ]);
        $this->emit('mantenimientAdd');
        $this->reset('mantenimient');
        $this->modalAdd = false;
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }

    public function deleteMantenimiento(ServiceMantenimient $mantenimient)
    {
        $mantenimient->delete();
        $this->modalDel = false;
        $this->emit('mantenimientSup');
    }

    public function addModalActivity() {
        $this->reset('actividad');
        $this->modalAddActivity = true;
    }


    public function saveActividad()
    {
        if (isset($this->actividad->id)) {
            $this->actividad->save();
        } else {
            $this->servicemantenimiento->activities()->create([
                'description' => $this->description,
            ]);
        }
        $this->emit('activityAdd');
        $this->reset('actividad');
        $this->modalAddActivity = false;
    }

    public function deleteActividad(ModelsActivity $activity)
    {
        $activity->delete();
        $this->emit('mantenimientSup');
    }


    public function editActivity(ModelsActivity $activity)
    {
        $this->actividad = $activity;
        $this->description = $this->actividad->description;
        $this->modalAddActivity = true;
    }
}
