<?php

namespace App\Http\Livewire\Report;

use App\Models\Commission;
use App\Models\Report;
use App\Models\User;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $modalAdd = false;
    public $modalDel = false;
    public $search = '';
    public $report;
    public $tipo;
    public $selectedCommission;
    public $estado;
    public $fechactual;
    public $fechafinComision;
    public $asunto = 'INFORME DE ACTIVIDADES REALIZADAS EN LA ';

    protected $rules = [
        'asunto' => 'required|min:20',
        'selectedCommission' => 'required',
        'fechactual' => 'required'
    ];

    public function render()
    {
        $user = auth()->user();

        $reports = Report::all();

        $this->fechactual = date('Y-m-d');
        if ($this->selectedCommission && $this->asunto = 'INFORME DE ACTIVIDADES REALIZADAS') {
            $commission = Commission::find($this->selectedCommission);
            $this->asunto = $this->asunto . ' ' . $commission->name;
        } elseif ($this->selectedCommission) {
            $this->reset('asunto');
        }

        $commissions = User::find($user->id)
        ->commissions()
        ->where('estado','CONFIRMADA')
        ->orderBy('id','desc')
        ->paginate(10);

        return view('livewire.report.index',[
            'reports' => $reports,
            'commissions' => $commissions,
            'user' => $user,
        ]);
    }

    
}
