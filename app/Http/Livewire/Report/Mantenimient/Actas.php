<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Acta;
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

    public $fechaActual;
    public $fechaActa;

    protected $rules = [
        'image' => 'required|file|max:3064',
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
        $carpeta = 'ActaMantenimientos' . '/'. 'Acta'.$this->estation->id.$this->estation->name;
        $name = 'ActaMantenimiento'.$this->estation->name.now()->timestamp.'.pdf';
        $acta_url = $this->file_url->storeAs($carpeta,$name);

        if (isset($this->acta->id)) {
            Storage::delete($this->acta->file_url);

            $this->acta->name = 'ActaMantenimiento'.'-'.'-'.$this->estation->name.'-'.$this->fechaActa;
            $this->acta->fecha = $this->fechaActa;
            $this->acta->file_url =  $acta_url;
        } else {
            $this->informe->actas()->create([
                'name' => 'ActaMantenimiento'.'-'.'-'.$this->estation->name.'-'.$this->fechaActa,
                'fecha' => $this->fechaActa,
                'estation_id' => $this->estation->id,
                'file_url' => $acta_url,
            ]);
        }

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

    public function editModal(Acta $acta) {
        $this->acta = $acta;
        $this->fechaActa = $acta->fecha;
        $this->file_url = $acta->file_url;
        $this->modalAdd = true;
    }
}
