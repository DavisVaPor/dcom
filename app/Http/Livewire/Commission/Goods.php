<?php

namespace App\Http\Livewire\Commission;

use App\Models\Commission;
use App\Models\Good;
use Livewire\Component;
use Livewire\WithPagination;

class Goods extends Component
{
    use WithPagination;
    public $commission;
    public $search ='';
    public $searchserie;
    public $selectedArticle;
    public $modalAdd = false;
    public $modalDel = false;

    protected $listeners = ['articleAttach' => 'render',
    'articleDetach' => 'render',];

    public function mount(Commission $commission)
    {
        $this->commission = $commission;
    }
    
    public function render()
    {
        $articles = Good::where('station_id','0')
        ->where('denominacion','LIKE','%'.$this->search.'%')
        ->where('serie','LIKE','%'.$this->searchserie.'%')
        ->paginate(10);

        return view('livewire.commission.goods',[
            'articles' => $articles,
        ]);
    }

    public function addModal()
    {
        $this->modalAdd = true;
        $this->reset('search','searchserie');
    }

    public function addArticle()
    {
        $this->commission->goods()->attach($this->selectedArticle);
        $this->modalAdd = false;
        $this->emit('articleAttach');
    }
    
    public function delArticle()
    {
        $this->commission->goods()->detach($this->modalDel);
        $this->modalDel = false;
        $this->emit('articleDetach');

    } 

    public function mostrarDel($id)
    {
        $this->modalDel = $id;
    }
}
