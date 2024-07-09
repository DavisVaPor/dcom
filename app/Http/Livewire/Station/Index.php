<?php

namespace App\Http\Livewire\Station;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Station;
use App\Models\Ubigeo;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $station;
    public $provincia;
    public $paginate = 15;
    public $estadoSearch;
    public $provinciaSearch;
    public $tipoSearch;
    public $tipoPy;
    public $ubigeo;
    public $sistemaSearch;
    public $energiaSearch;
    public $siniestradoSearch;
    public $search = '';
    public $chanel,$fm;
    public $altitud,$codStation; 

    public $modal = false;
    public $modalDel = false;

    protected $rules = [
        'station.name' => 'required',
        'ubigeo' => 'required',
        'tipoPy' => 'required',
        'station.lat' => 'required',
        'station.lon' => 'required',
        'station.sistema' => 'required',
        'station.tipo' => 'required',
        'station.estado' => 'required',
        'station.energia' => 'required',
    ];


    public function render()
    {   $estations = Station::where('name','LIKE','%'.$this->search.'%')
                            ->where('tipoPy','LIKE',$this->tipoSearch.'%')
                   /*         ->where('sistema','LIKE',$this->sistemaSearch.'%')
                            ->where('siniestrado','LIKE',$this->siniestradoSearch.'%')
                            ->where('energia','LIKE',$this->energiaSearch.'%')
                            ->where('estado','LIKE','%'.$this->estadoSearch.'%')
                             ->where('ubigeo_id','LIKE','%'.$this->provinciaSearch.'%')
                            ->orderBy('name','asc') */
                            ->latest('id')->paginate($this->paginate);

        //$estations = Station::paginate(15);

        $ubigeos = Ubigeo::where('provincia','LIKE',$this->provincia )->get();

        return view('livewire.station.index',[
            'estations' => $estations,
            'ubigeos' => $ubigeos,
        ]);
    }

    public function addstation()
    {
        $this->modal = true;
        $this->reset('station','ubigeo','codStation','tipoPy','altitud');
        $this->reset('chanel','fm','codStation','tipoPy','altitud');
    }

    public function saveStation()
    {
        $this->validate();
        if (isset($this->estation->id)) {
            $this->estation->save();
        } else {
            Station::create([
                'name' => Str::upper($this->station['name']),
                'ubigeo_id' => $this->ubigeo,
                'slug' => Str::slug($this->station['name'],'-'),
                'codestation' => $this->codStation,
                'tipoPy' => $this->tipoPy,
                'latitud' => $this->station['lat'],
                'longitud' => $this->station['lon'],
                'altitud' => $this->altitud,
                'frec_canal' => $this->chanel,
                'frec_fm' => $this->fm,
                'estado' => $this->station['estado'],
                'energia' => $this->station['energia'],
                'situacion' => $this->station['situacion'],
                'sistema' => $this->station['sistema'],
                'tipo' => $this->station['tipo'],
            ]);
        }
        $this->modal = false;
    }
}
