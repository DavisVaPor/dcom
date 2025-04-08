<?php

namespace App\Http\Livewire\Station;

use App\Models\Station;
use App\Models\Ubigeo;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $station;
    public $tipoPy;
    public $modal = false;

    public $distrito;
    public $provincia;

    public $name;
    public $latitud;
    public $longitud;
    public $sistemaSearch;
    public $energiaSearch;
    public $siniestradoSearch;
   
    public $search = '';
    public $chanel = 0,$fm = 0;
    public $altitud,$codStation, $tipo,$estado, $energia, $sistema, $situacion; 

    public function render()
    {
        $this->provincia = $this->station->ubigeo->provincia;
        $ubigeos = Ubigeo::where('provincia','LIKE',$this->provincia )->get();

        return view('livewire.station.edit',[
           'ubigeos' => $ubigeos,
        ]);
    }

    public function mount(Station $estation)
    {
        $this->station = $estation;
    }

    function editEstacion(){
        $this->modal = true;
        $this->distrito = $this->station->ubigeo_id;

        $this->name = $this->station->name;
        $this->latitud = $this->station->latitud;
        $this->longitud = $this->station->longitud;
        $this->altitud = $this->station->altitud;
        $this->codStation = $this->station->codestation;
        $this->tipoPy = $this->station->tipoPy;
        $this->chanel = $this->station->frec_canal;
        $this->fm = $this->station->frec_fm;
        $this->estado = $this->station->estado;
        $this->energia = $this->station->energia;
        $this->sistema = $this->station->sistema;
        $this->tipo = $this->station->tipo;
        $this->situacion = $this->station->situacion;
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
