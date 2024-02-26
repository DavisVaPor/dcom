<?php

namespace App\Http\Livewire\Comissions;

use App\Models\Commission;
use Livewire\Component;
use Livewire\WithPagination;

class Commissions extends Component
{
    use WithPagination;

    public $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    public $modalAdd = false;
    public $modalDel = false;
    public $search = '';
    public $searchcode = '';
    public $commission;
    public $nameCommision = 'Comisión de Servicio';
    public $estado;
    public $tipofiltro;
    public $tipo = '';
    public $mes, $anho;
    public $fechainicio, $fechafin, $periodo;
    public $fechaActual;

    public function render()
    {
        $commissions = Commission::where('comision', 'LIKE', '%' . $this->search . '%')
        ->where('numero', 'LIKE', '%' . $this->searchcode . '%')
        ->where('estado', 'LIKE', '%' . $this->estado . '%')
        ->where('tipo', 'LIKE', '%' . $this->tipofiltro . '%')
        ->where('mes', 'LIKE', '%' . $this->mes . '%')
        ->where('year', 'LIKE', '%' . $this->anho)
        ->latest('id')
        ->paginate(15);

        return view('livewire.comissions.commissions',[
            'commissions' => $commissions,
        ]);
    }
}
