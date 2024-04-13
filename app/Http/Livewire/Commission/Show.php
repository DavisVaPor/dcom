<?php

namespace App\Http\Livewire\Commission;

use App\Models\Commission;
use Livewire\Component;

class Show extends Component
{
    public $commission;
    public $modalConf= false;
    public $modalPen=false;

    protected $listeners = [
    'commissionPen' => 'render',
    'commissionConfi' => 'render',
    'commissionAnu' => 'render',
    ];

    public function mount(Commission $commission)
    {
        $this->commission = $commission;
    }
    
    public function render()
    {
        return view('livewire.commission.show');
    }

    public function mostarConf()
    {
       $this->modalConf = true;
    }

    public function Confirmar()
    {
        if ($this->commission->users->isNotEmpty()) {
            $confirmar = Commission::findOrFail($this->commission->id);

            $confirmar->estado = 'CONFIRMADO';

            $confirmar->save();

            $this->emit('commissionConfi');

            $this->modalConf = false;
        }
    }

    public function mostrarPen()
    {
       $this->modalPen = true;
    }

    public function Pendiente()
    {
        $pendiente = Commission::findOrFail($this->commission->id);

        $pendiente->estado = 'PENDIENTE';

        $pendiente->save();
        
        $this->emit('commissionPen');

        $this->modalPen = false;
    }
}
