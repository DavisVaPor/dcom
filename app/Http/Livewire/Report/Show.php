<?php

namespace App\Http\Livewire\Report;

use App\Models\Ballot;
use App\Models\Commission;
use App\Models\Report;
use Livewire\Component;

class Show extends Component
{
    public $report;
    public $modalPre = false;
    public $modalPen = false;
    public $modalRev = false;

    public function mount(Report $informe)
    {
        $this->report = $informe;
    }

    protected $listeners = [
        'updatedoc' => 'render',
    ];

    public function render()
    {
        return view('livewire.report.show');
    }

    public function mostrarPre()
    {
        $this->modalPre = true;
    }

    public function Presentar()
    {
        $presentar = Report::findOrFail($this->report->id);

        $presentar->estado = 'PRESENTADO';

        $presentar->save();

        $this->report = Report::findOrFail($this->report->id);
        
        $this->modalPre = false;

        $commision =  Commission::find($this->report->commission_id);

        //Papeleta de Entrada
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
        
        foreach ($commision->goods() as $item) {
            $item->pivot->estado = 'ASIGNADO';
            $item->pivot->save();
        }

        $this->emit("updatedoc");

    }

    public function mostrarPen()
    {
        $this->modalPen = true;
    }

    public function Borrador()
    {
        $presentar = Report::findOrFail($this->report->id);

        $presentar->estado = 'BORRADOR';

        $presentar->save();

        $this->reset('report');

        $this->modalPre = false;
    }

    public function mostrarRev()
    {
        $this->modalRev = true;
    }

    public function Revisar()
    {
        $revisado = Report::findOrFail($this->report->id);

        $revisado->estado = 'REVISADO';

        $revisado->save();

        $this->reset('report');

        $this->modalRev = false;

        $commision =  Commission::find($this->report->commission_id);
        $commision->estado = 'REALIZADA';
        $commision->save();

        return redirect()->route('bandeja.index');
    }

    public function regresar(){
        return redirect()->route('informes');
    }
}
