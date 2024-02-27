<?php

namespace App\Http\Livewire\Station;

use Livewire\Component;

use App\Models\Station;
use App\Models\Ubigeo;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $estation;
    public $provincia;
    public $paginate = 15;
    public $estado;
    public $provinciaSearch;
    public $distritoSearch;
    public $tipo;
    public $ubigeo;
    public $sistema;
    public $energia;
    public $siniestrado;
    public $search = '';

    public $modalAdd = false;
    public $modalDel = false;

    protected $rules = [
        'estation.name' => 'required',
        'estation.latitud' => 'required',
        'estation.longitud' => 'required',
        'estation.altitud' => 'required',
        'estation.urlgooglearth' => 'required',
        'estation.tipo' => 'required',
        'estation.terreno' => 'required',
        'estation.ubigeo_id' => 'required',
    ];


    public function render()
    {   $estations = Station::where('name','LIKE','%'.$this->search.'%')
                            ->where('ubigeo_id','LIKE',$this->provinciaSearch.'%')
                            ->where('tipo','LIKE',$this->tipo.'%')
                            ->where('sistema','LIKE',$this->sistema.'%')
                            ->where('siniestrado','LIKE',$this->siniestrado.'%')
                            ->where('energia','LIKE',$this->energia.'%')
                            ->where('estado','LIKE','%'.$this->estado.'%')
                            ->orderBy('name','asc')
                            ->latest('id')->paginate($this->paginate);
        
        //$ubigees = Ubigeo::where('provincia',$this->provincia )->get();

        return view('livewire.station.index',[
            'estations' => $estations,
            //'ubigees' => $ubigees,
        ]);
    }

    public function addModal()
    {
        $this->modalAdd = true;
    }

    public function saveEstation()
    {
        $this->validate();
        if (isset($this->estation->id)) {
            $this->estation->save();
        } else {
            Station::create([
                'name' => $this->estation['name'],
                'latitud' => $this->estation['latitud'],
                'longitud' => $this->estation['longitud'],
                'altitud' => $this->estation['altitud'],
                'urlgooglearth' => $this->estation['urlgooglearth'],
                'tipo' => $this->estation['tipo'],
                'terreno' => $this->estation['terreno'],
                'ubigeo_id' => $this->estation['ubigeo_id'],
            ]);
        }
        $this->modalAdd = false;
    }
}
