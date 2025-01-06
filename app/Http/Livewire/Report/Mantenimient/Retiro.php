<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Good;
use App\Models\ServiceMantenimient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Retiro extends Component
{

    public $article;
    public $estation;
    public $informe;
    public $fecha;
    public $modalDel = false;
    public $fechaActual, $servicemantenimiento;

    protected $rules = [
        'fecha' => 'required|before:fechaActual',
    ];

    public function mount(Good $article)
    {
        $this->article = $article;
    }

    protected $listeners = [
        'EquipoRetiro' => 'render',
    ];

    public function render()
    {
        $this->fechaActual = date('Y-m-d');
        $this->servicemantenimiento = ServiceMantenimient::where('station_id', $this->estation->id)->where('report_id',$this->informe->id)->first(); 


        return view('livewire.report.mantenimient.retiro');
    }

    public function openModal()
    {
        $this->reset('fecha');
        $this->modalDel = true;
    }

    public function retiro()
    {
        $this->validate();

        // $this->article->commissions()->attach($this->informe->commission->id);

        $this->article->movimients()->create([
            'tipo' => 'RETIRO',
            'fechamovimiento' => $this->fecha,
            'service_mantenimient_id' => $this->servicemantenimiento->id,
        ]);

        $this->article->station_id = null;
        $this->article->situacion = 'ALMACEN';
        $this->article->save();

        $this->emit('EquipoRetiro');

        $this->reset('fecha');

        $this->modalDel = false;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
