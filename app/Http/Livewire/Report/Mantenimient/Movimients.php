<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Good;
use App\Models\Movimient;
use App\Models\ServiceMantenimient;
use App\Models\Station;
use Livewire\Component;

class Movimients extends Component
{
    public $estation;
    public $informe;
    public $movimients;
    public $movement;
    public $estacion; 
    public $article, $servicemantenimiento;
    public $modalActa = false;
    public $modalSup = false;
    
    protected $listeners = [
        'movementDelete' => 'render',
        'EquipoInstall' => 'render',
        'EquipoRetiro' => 'render',
    ];

    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }
    
    public function render()
    {
        $this->servicemantenimiento = ServiceMantenimient::where('station_id', $this->estation->id)->where('report_id',$this->informe->id)->first(); 
        if($this->servicemantenimiento){
            $movimients = Movimient::where('service_mantenimient_id', $this->servicemantenimiento->id)->get();
        }

        return view('livewire.report.mantenimient.movimients',[
           
        ]);
    }

    public function deleteModal($id)
    {
        $this->movement = Movimient::findOrFail($id);
        $this->article = Good::findOrFail($this->movement->good->id);
        $this->modalSup = true;
    }

    public function deleteMovimient(Movimient $movement)
    {
        $this->article->estation_id = $this->movement->estacion_out;
        $movement->delete();
        $this->article->save();
        $this->reset('movement');
        $this->emit('movementDelete');
        $this->modalSup = false;
    }
}
