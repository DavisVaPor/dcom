<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\Report;
use App\Models\Station;
use Livewire\Component;

class Mantenimient extends Component
{
    public $informe, $searchEstation, $ubigeo;

    public function mount(Report $informe)
    {
        $this->informe = $informe;
    }
    
    
    public function render()
    {
        $estations = Station::where('name', 'LIKE',$this->searchEstation.'%' )
                    ->where('ubigeo_id','LIKE',$this->ubigeo.'%')
                    ->orderBy('name','asc')
                    ->paginate(15);

        return view('livewire.report.mantenimient.mantenimient',[
            'estations' => $estations,
        ]
    );
    }


    

}
