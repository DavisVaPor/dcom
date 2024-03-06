<?php

namespace App\Http\Livewire\Good;

use App\Models\Good;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {

        $goods = Good::all();
        return view('livewire.good.index',[
            'goods' => $goods,
        ]);
    }
}
