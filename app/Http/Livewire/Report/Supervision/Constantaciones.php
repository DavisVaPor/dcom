<?php

namespace App\Http\Livewire\Report\Supervision;

use App\Models\Finding;
use App\Models\Report;
use App\Models\Ubigeo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class Constantaciones extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $report, $ubigeo, $imagen;
    public $finding, $fechaActual;
    public $modalAdd = false;

    protected $rules = [
        'finding.ubicacion' => 'required',
        'ubigeo' => 'required',
        'finding.servicio' => 'required',
        'finding.caracteristicas' => 'required',
        'finding.fecha' => 'required|before:fechaActual',
        'imagen' => 'required | image',
    ];

    protected $listeners = [
        'findingAdd' => 'render',
        'findingSup' => 'render',
    ];

    public function mount(Report $informe)
    {
        $this->report = $informe;
    }
    
    public function render()
    {   
        $this->fechaActual = date('Y-m-d');
        return view('livewire.report.supervision.constantaciones');
    }

    public function addModal()
    {
        $this->reset('finding', 'ubigeo','imagen');
        $this->modalAdd = true;
    }

    public function save()
    {
        $this->validate();
        if (isset($this->finding->id)) {
            $this->finding->save();
        } else {
            $ubigo = Ubigeo::where('id', $this->ubigeo)->first(); 

            $carpeta = 'public'.'/'.'CONSTATACIONES'.'/'.$ubigo->provincia.'/'.$ubigo->distrito;
            $name = 'Constatacion'.$this->finding['fecha'].'.png';

            $imagen_url = $this->imagen->storeAs($carpeta,$name);  

            Finding::create([
                'fechaConstatacion' => $this->finding['fecha'],
                'Radiodifusion' => $this->finding['servicio'],
                'ubigeo_id' => $this->ubigeo,
                'ubicacion' => Str::upper($this->finding['ubicacion']),
                'caracteristicas' => $this->finding['caracteristicas'],
                'observaciones' => $this->finding['observaciones'],
                'imagen' => $imagen_url,
                'report_id' => $this->report->id,
            ]);
        }
        $this->emit('findingAdd');
        $this->modalAdd = false;
    }
}
