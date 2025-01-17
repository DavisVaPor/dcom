<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\ImageService;
use App\Models\ServiceMantenimient;
use Livewire\WithFileUploads;
use App\Models\Station;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class Galery extends Component
{
    use WithFileUploads;

    public $estation;
    public $informe;
    public $imagen, $servicemantenimiento;
    public $modalAdd = false;
    public $modalDel = false;

    protected $listeners = [
        'imageSave' => 'render',
        'imageSup' => 'render'
    ];

    protected $rules = [
        'imagen' => 'required|image',
    ];

    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }


    public function render()
    {
        $this->servicemantenimiento = ServiceMantenimient::where('station_id', $this->estation->id)->where('report_id',$this->informe->id)->first(); 

        return view('livewire.report.mantenimient.galery');
    }

    public function addModalImage()
    {
        $this->modalAdd = true;
    }

    public function saveImage()
    {
        $this->validate();
        $carpeta = 'public'.'/'.'GaleriaMant'.'/'.$this->estation->id.$this->estation->name;
        $name = date('YmdHis').$this->servicemantenimiento->id.'.jpg';
        $imagen_url = $this->imagen->storeAs($carpeta,$name);

        $this->servicemantenimiento->images()->create([
            'name' => 'estation' . '-' . $this->estation->id . $this->estation->name.date('YmdHis'),
            'image' => $imagen_url,
        ]);
        $this->modalAdd = false;

        $this->emit('imageSave');  
        $this->reset(['imagen']);
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }

    public function deleteImage(ImageService $image)
    {
        $url = str_replace('storage', 'public', $image->url);

        Storage::delete($url);
        $image->delete();
        $this->modalDel = false;
        $this->emit('imageSup');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
