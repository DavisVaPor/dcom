<?php

namespace App\Http\Livewire\Good;

use App\Models\Category;
use App\Models\Good;
use App\Models\Station;
use App\Models\System;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $searchserie = '';
    public $estation = '';
    public $modalAdd = false;
    public $article;
    public $tipo = 'ACTIVO';
    public $cantidad = 1;
    public $codPatrimonial;

    protected $rules = [
        'codPatrimonial' => 'required|size:12',
        'article.denominacion' => 'required',
        'tipo' => 'required',
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

    public function render()
    {
        $goods = Good::where('denominacion','LIKE','%'.$this->search.'%')
                ->where('serie','LIKE','%'.$this->searchserie.'%')
                ->where('station_id','LIKE','%'.$this->estation)
                ->latest('denominacion');

        $categories = Category::all();

        $systems = System::all();

        $stations = Station::all();
        $goods = Good::all();
        return view('livewire.good.index',[
            'goods' => $goods,
            'stations' => $stations,
            'categories' => $categories,
            'systems' => $systems,
        ]);
    }

    public function add()
    {
        $this->modalAdd = true;
        $this->reset('article','codPatrimonial','tipo');
    }

    public function saveArticle()
    {
        $this->validate();

        Good::create([
            'codPatrimonial' => $this->codPatrimonial,
            'denominacion' => $this->article['denominacion'],
            'slug' => Str::slug($this->article['denominacion'],'-'),
            'tipo' => $this->tipo,
            'cantidad' => $this->cantidad,
            'marca' => $this->article['marca'],
            'modelo' => $this->article['modelo'],
            'category_id' => $this->article['category_id'],
            'color' => $this->article['color'],
            'serie' => $this->article['nserie'],
            'condicion' => $this->article['condicion'],
            'operatividad' => $this->article['operatividad'],
            'situacion' => $this->article['situacion'],
            'system_id' => $this->article['system_id'],
        ]);
        
        $this->modalAdd = false;
        $this->reset('article','codPatrimonial');
    }

    public function edit(Good $article)
    {
        $this->article = $article;
        $this->modalAdd = true;

    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
