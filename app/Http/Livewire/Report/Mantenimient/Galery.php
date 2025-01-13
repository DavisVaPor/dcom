<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Station;
use Livewire\Component;

class Galery extends Component
{
    public $estation;
    public $informe;

    protected $listeners = [
        'activityAdd' => 'render',
        'activitySup' => 'render', 
        'imageSave' => 'render',
        'imageSup' => 'render'
    ];

    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }
    

    public function render()
    {
        return view('livewire.report.mantenimient.galery');
    }

    
}
