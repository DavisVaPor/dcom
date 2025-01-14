<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Acta;
use App\Models\ServiceMantenimient;
use App\Models\Station;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Actas extends Component
{
    use WithFileUploads;
    public $informe;
    public $estation;
    public $acta;
    public $modalAdd = false;
    public $file_url;
    public $modalInfo = false;
    public $visualizarActa;
    public $modalEliminar = false;
    public $servicemantenimiento;

    public $fechaActual;
    public $fechaActa;

    protected $rules = [
        'file_url' => 'required|file|max:3064',
        'fechaActa' => 'required|date|before:fechaActual',
    ];

    protected $listeners = [
        'acta' => 'render',
        'ActaDelete' => 'render',
    ];

    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }

    public function render()
    {
        $this->servicemantenimiento = ServiceMantenimient::where('station_id', $this->estation->id)->where('report_id',$this->informe->id)->first(); 
        $this->fechaActual = date('Y-m-d');
        return view('livewire.report.mantenimient.actas');
    }

    public function addModal()
    {
        $this->reset(['file_url', 'acta','fechaActa']);
        $this->modalAdd = true;
    }

    public function save()
    {   
        $this->validate();
        $carpeta = 'public'.'/'.'ActaMantenimientos'.'/'.$this->estation->id.$this->estation->name;
        $name = 'ActaMantenimiento'.$this->servicemantenimiento->id.'.pdf';
        $acta_url = $this->file_url->storeAs($carpeta,$name);

            $this->servicemantenimiento->actas()->create([
                'acta' => 'ActaMantenimiento'.'-'.$this->estation->name.'-'.$this->fechaActa,
                'fechaActa' => $this->fechaActa,
                'file_url' => $acta_url,
            ]);

        $this->emit('acta');
        $this->reset(['file_url', 'acta']);
        $this->modalAdd = false;
    }

    public function infoActa(Acta $acta) {
        
        $this->visualizarActa =  $acta;
        $this->modalInfo = true;
    }

    public function deleteModal($id)
    {
        $this->modalEliminar =  Acta::findOrFail($id)->first();
    }

    public function deleteActa(Acta $acta)
    {
        Storage::delete($acta->file_url);
        $acta->delete();
        $this->modalEliminar = false;
        $this->reset('acta');
        $this->emit('ActaDelete');
    }
}
