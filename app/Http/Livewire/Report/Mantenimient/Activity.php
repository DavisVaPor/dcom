<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Station;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Activity extends Component
{
    public $informe;
    public $estation;
    public $mantenimient;
    public $servicio;
    public $selectedEstation;

    public $estadoEstacion;

    public $modalAdd = false;
    public $modalDel = false;

    protected $rules = [
        'mantenimient.servicio' => 'required',
    ];

    protected $listeners = [
        'mantenimientAdd' => 'render',
        'mantenimientSup' => 'render',
        'mantenimientoadd'=> 'render',
    ];

    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }

    public function render()
    {
        return view('livewire.report.mantenimient.activity');
    }

    public function addModal()
    {
        $this->reset('activity');
        $this->modalAdd = true;
    }

    public function saveActivity()
    {
        $this->validate();
        if (isset($this->activity->id)) {
            $this->activity->save();
        } else {
            $this->informe->servicemantenimiento()->create([
                'servicio' => Str::upper($this->activity['servicio']),
                'estation_id' => $this->estation->id,
                //'manteniemient_id' => $this->informe->mantenimient->id,
            ]);
        }
        $this->emit('activityAdd');
        $this->reset('activity');
        $this->modalAdd = false;
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }

    public function deleteActivity(Activity $activity)
    {
        foreach ($activity->images as $image) {
            $url = str_replace('storage','public',$image->url);
            Storage::delete($url);
        }
        $activity->delete();
        $this->modalDel = false;
        $this->emit('mantenimientSup');
    }

    public function editActivity(Activity $activity)
    {
        $this->activity = $activity;
        $this->selectedEstation = $this->activity->estation_id;
        $this->modalAdd = true;
    }
}
