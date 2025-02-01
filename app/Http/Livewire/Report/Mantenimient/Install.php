<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Good;
use App\Models\ServiceMantenimient;
use App\Models\Station;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Install extends Component
{
    public $estation;
    public $informe;
    public $ArticleSelect;
    public $fecha;
    public $article , $servicemantenimiento;
    public $fechaActual;

    public $modalAdd =  false;

    protected $rules = [
        'ArticleSelect' => 'required',
        'fecha' => 'required|date|before:fechaActual',
    ];

    protected $listeners = [
        'EquipoInstall' => 'render',
        'mantenimientAdd' => 'render',
        'mantenimientSup' => 'render',
    ];

    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }
    
    public function render()
    {
        $this->servicemantenimiento = ServiceMantenimient::where('station_id', $this->estation->id)->where('report_id',$this->informe->id)->first(); 

        $this->fechaActual = date('Y-m-d');

        $articles = $this->informe->commission->goods;

        return view('livewire.report.mantenimient.install',[
            'articles' => $articles,            
        ]);
    }

    public function addModal()
    {
        $this->reset('ArticleSelect','fecha');
        $this->modalAdd = true;
    }

    public function moviment()
    {
        $this->validate();
        $article = Good::findOrFail($this->ArticleSelect);

        $article->movimients()->create([
            'tipo' => 'INSTALACION',
            'fechamovimiento' => $this->fecha,
            'service_mantenimient_id' => $this->servicemantenimiento->id,
        ]);
        
        $article->station_id = $this->estation->id;
        $article->situacion = 'INSTALADO';
        $article->save();
        $this->modalAdd = false;

        $this->emit('EquipoInstall');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
