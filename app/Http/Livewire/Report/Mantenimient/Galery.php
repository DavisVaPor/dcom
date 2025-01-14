<?php

namespace App\Http\Livewire\Report\Mantenimient;

use App\Models\ImageService;
use App\Models\Station;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class Galery extends Component
{
    public $estation;
    public $informe;
    public $imagen;
    public $modalAdd = false;
    public $modalDel = false;

    protected $listeners = [
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

    public function addModalImage()
    {
        $this->modalAdd = true;
    }

    public function delImage($id)
    {
        $this->reset('image');
        $this->imagen = '';
        $this->modalDel = $id;
    }

    public function saveImage()
    {
        $this->validate();

        if (isset($this->image->id)) {
            $this->image->save();
        } else {
            $imagen = $this->imagen->store($this->informe->id.$this->estation->id.'/img');
            
                $this->activity->images()->create([
                    'name' => 'estation'.'-'.$this->estation->id.$this->estation->name,
                    'imagen' => $imagen,
                ]);

            $this->reset(['image','imagen']);
        }
        $this->emit('imageSave');
    }

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }

    public function deleteImage(ImageService $image)
    {
        $url = str_replace('storage','public',$image->url);
        
        Storage::delete($url);
        $image->delete();
        $this->modalDel = false;
        $this->emit('imageSup');
    }
}
