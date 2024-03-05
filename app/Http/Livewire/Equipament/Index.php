<?php

namespace App\Http\Livewire\Equipament;

use App\Models\Category;
use App\Models\Equipament;
use App\Models\Equipment;
use App\Models\Station;
use App\Models\System;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    
    public function render()
    {
        return view('livewire.equipament.index',[
           
        ]);
    }    
}
