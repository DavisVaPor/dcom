<?php

namespace App\Http\Livewire\Station;

use App\Models\Category;
use App\Models\Good;
use App\Models\Station;
use App\Models\System;
use Livewire\Component;
use Illuminate\Support\Str;


class Inventary extends Component
{
    public $estation;
    public $article;
    public $system;
    public $search;
    public $modalOpen = false;
    public $codPatrimonial;

    protected $rules = [
        'codPatrimonial' => 'required|size:12',
        'article.denominacion' => 'required',
        'article.marca' => 'required',
        'article.modelo' => 'required',
        'article.color' => 'required',
        'article.nserie' => 'required',
        'article.condicion' => 'required',
        'article.operatividad' => 'required',
        'article.situacion' => 'required',
        'article.category_id' => 'required',
        'article.system_id' => 'required',
    ];

    protected $listeners = [
        'articleinveset' => 'render',
    ];


    public function mount(Station $estation)
    {
        $this->estation = $estation;
    }
    
    public function render()
    {
        $articles = Good::where('station_id',$this->estation->id)
                    ->where('denominacion','LIKE','%'.$this->search.'%')
                    ->where('system_id','LIKE','%'.$this->system.'%')
                    ->paginate(15);

        $categories = Category::all();
        $systems = System::all();

        return view('livewire.station.inventary',[
            'articles' => $articles,
            'categories' => $categories,
            'systems' => $systems,            
        ]);
    }

    function modalOpen() {
        $this->modalOpen = true;
        $this->reset('article');

    }

    public function saveArticle()
    {
        $this->validate();

        Good::create([
            'codPatrimonial' => $this->codPatrimonial,
            'denominacion' => $this->article['denominacion'],
            'slug' => Str::slug($this->article['denominacion'],'-'),
            'tipo' => 'ACTIVO',
            'marca' => $this->article['marca'],
            'modelo' => $this->article['modelo'],
            'category_id' => $this->article['category_id'],
            'color' => $this->article['color'],
            'serie' => $this->article['nserie'],
            'condicion' => $this->article['condicion'],
            'operatividad' => $this->article['operatividad'],
            'situacion' => $this->article['situacion'],
            'system_id' => $this->article['system_id'],
            'station_id' => $this->estation->id,
        ]);

        $this->emit('articleinveset');
        $this->modalOpen = false;
        $this->reset('article');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
