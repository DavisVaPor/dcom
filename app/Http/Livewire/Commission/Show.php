<?php

namespace App\Http\Livewire\Commission;

use App\Models\Ballot;
use App\Models\Commission;
use Livewire\Component;

class Show extends Component
{
    public $commission;
    public $modalConf = false;
    public $modalPen = false;

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

            if ($this->commission->tipo == "MANTENIMIENTO") {
                if ($this->commission->stations->isNotEmpty()) {
                    $confirmar = Commission::findOrFail($this->commission->id);

                    $confirmar->estado = 'CONFIRMADO';

                    $confirmar->save();

                    $this->emit('commissionConfi');
                }
            } else {
                if ($this->commission->ubigees->isNotEmpty()) {
                    $confirmar = Commission::findOrFail($this->commission->id);

                    $confirmar->estado = 'CONFIRMADO';

                    $confirmar->save();

                    $this->emit('commissionConfi');
                }
            }
        }

        if ($this->commission->goods->isNotEmpty()) {

            $ballot = Ballot::all();

            if ($ballot->isEmpty() == true) {
                $numero = 1;
            } else {
                $lastnum = $ballot->last();

                if ($lastnum->year == date('Y')) {
                    $numero = 1;
                } else {
                    $numero = $lastnum->numero + 1;
                }
            };

            $ballotid = Ballot::create([
                'tipo' => 'SALIDA',
                'numero' => $numero,
                'year' => date('Y'),
                'commission_id' => $this->commission->id,
            ]);

            $goods = $this->commission->goods;

            foreach ($goods as $good) {
                $ballotid->goods()->attach($good);
            }
        }

        $this->modalConf = false;

        return redirect()->route('commissions');
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

        $ballot_id = Ballot::firstWhere('commission_id', $this->commission->id);

        $ballot_id->delete();

        return redirect()->route('commision.show', $this->commission->slug);

        $this->modalPen = false;
    }
}
