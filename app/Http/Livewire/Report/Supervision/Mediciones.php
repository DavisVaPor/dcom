<?php

namespace App\Http\Livewire\Report\Supervision;

use App\Models\Measurement;
use App\Models\Report;
use App\Models\Ubigeo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class Mediciones extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $report;
    public $measurement;
    public $latgra, $latmin, $latseg;
    public $latitud;
    public $longra, $lonmin, $lonseg;
    public $longitud;
    public $ubigeo;
    public $modalAdd = false;
    public $modalDel = false;
    public $imagen;
    public $openimagen;
    public $modalImagen = false;
    public $fechaActual;

    protected $rules = [
        'measurement.ubicacion' => 'required',
        'latgra' => 'required',
        'latmin' => 'required',
        'latseg' => 'required',
        'longra' => 'required',
        'lonmin' => 'required',
        'lonseg' => 'required',
        'ubigeo' => 'required',
        'measurement.rni' => 'required',
        'measurement.fecha' => 'required|before:fechaActual',
        'imagen' => 'required | image',
    ];

    protected $listeners = [
        'measurementAdd' => 'render',
        'measurementSup' => 'render',
    ];

    public function mount(Report $informe)
    {
        $this->report = $informe;
    }
    
    public function render()
    {
        $this->fechaActual = date('Y-m-d');
        return view('livewire.report.supervision.mediciones');
    }

    public function addModal()
    {
        $this->reset('measurement', 'ubigeo', 'latgra', 'latmin', 'latseg', 'longra', 'lonmin', 'lonseg','imagen');
        $this->modalAdd = true;
    }

    public function save()
    {
        $this->validate();
        $this->latitud = $this->latgra . '°' . $this->latmin . "'" . $this->latseg . '"' . ' S';
        $this->longitud = $this->longra . '°' . $this->lonmin . "'" . $this->lonseg . '"' . ' W';
        if (isset($this->measurement->id)) {
            $this->measurement->save();
        } else {
            $ubigo = Ubigeo::where('id', $this->ubigeo)->first(); 

            $carpeta = 'public'.'/'.'RNI'.'/'.$ubigo->provincia.'/'.$ubigo->distrito;
            $name = 'Mendicion_rni'.$this->measurement['fecha'].'.png';

            $imagen_url = $this->imagen->storeAs($carpeta,$name);  

            Measurement::create([
                'ubicacion' => Str::upper($this->measurement['ubicacion']),
                'latitud' => $this->latitud,
                'longitud' => $this->longitud,
                'maps' => 'https://www.google.com/maps/place/' . $this->latitud . ' ' . $this->longitud,
                'valor_rni' => $this->measurement['rni'],
                'fecha_medicion' => $this->measurement['fecha'],
                'imagen' => $imagen_url,
                'ubigeo_id' => $this->ubigeo,
                'report_id' => $this->report->id,
            ]);
        }
        $this->emit('measurementAdd');
        $this->modalAdd = false;
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }

    public function del($id)
    {
        $this->reset('measurement');
        $this->modalDel = $id;
    }

    public function delete(Measurement $medicion)
    {
        $measurement =  $medicion;
        
        $url = str_replace('storage', 'public', $measurement->imagen);
        Storage::delete($url);

        $measurement->delete();
        $this->modalDel = false;
        $this->emit('measurementSup');
    }

    public function edit(Measurement $measurement)
    {
        $this->measurement = $measurement;

        $this->latitud = $this->measurement->latitud;
        $this->longitud = $this->measurement->longitud;

        $this->latgra = $this->measurement->latitud;
        $this->latmin = $this->measurement->latmin;
        $this->latseg = $this->measurement->latseg;

        $this->longra = $this->measurement->longra;
        $this->lonmin = $this->measurement->longmin;
        $this->lonseg = $this->measurement->longseg;

        $this->latitud = $this->latgra . '°' . $this->latmin . "'" . $this->latseg . '"' . ' S';
        $this->longitud = $this->longra . '°' . $this->lonmin . "'" . $this->lonseg . '"' . ' W';
        $this->ubigeo = $this->measurement->ubigeo->id;
        $this->imagen = $this->measurement->imagen;

        $this->modalAdd = true;
    }
    
    public function openModalImage(Measurement $measurement)
    {
        $this->measurement = $measurement;
        $this->openimagen = $measurement; 
        $this->modalImagen = true;
    }
}
