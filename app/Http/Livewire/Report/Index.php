<?php

namespace App\Http\Livewire\Report;

use App\Models\Commission;
use App\Models\Report;
use App\Models\User;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

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

    public $ultimo;

    protected $rules = [
        'asunto' => 'required|min:20',
        'selectedCommission' => 'required',
        'fechactual' => 'required|after:fechafinComision'
    ];

    public function render()
    {
        $user = auth()->user();

        $reports = Report::all();

        $this->fechactual = date('Y-m-d');

        if ($this->selectedCommission && $this->asunto = 'INFORME DE ACTIVIDADES REALIZADAS') {
            $commission = Commission::find($this->selectedCommission);
            $this->asunto = $this->asunto . ' ' . $commission->comision;
        } elseif ($this->selectedCommission) {
            $this->reset('asunto');
        }

        $commissions = User::find($user->id)
        ->commissions()
        ->where('estado','CONFIRMADO')
        ->orderBy('id','desc')->get();



        return view('livewire.report.index',[
            'reports' => $reports,
            'commissions' => $commissions,
            'user' => $user,
        ]);
    }

    public function addReport()
    {
        $this->reset('report','asunto','selectedCommission');
        $this->modalAdd = true;
    }

    public function saveReport()
    {
        $commission = Commission::find($this->selectedCommission);
        $tipo = $commission->tipo;
        
        $ultimo = Report::where('user_id',auth()->user()->id)->latest()->first();

        if ($ultimo) {
            if (strftime('%Y', strtotime($this->fechactual)) != date('Y')) {
             $num = 0;
             } else {
                 $num =  $ultimo->numero + 1;
             }
         }else{
             $num = 0;
         }

        $this->validate();
        if (isset($this->report->id)) {
            $this->report->asunto = $this->asunto;
            $this->report->commission_id =  $this->selectedCommission;
            $this->report->save();
        } else {
            $newreport = Report::create([
                'asunto' => Str::upper($this->asunto),
                'slug' => Str::slug($this->asunto,'-'),
                'tipo' => $tipo,
                'numero' => $num + 1,
                'fechaCreacion' => $this->fechactual,
                'anho' => date('Y'),
                'user_id' => auth()->user()->id,
                'estado' => 'BORRADOR',
                'commission_id' => $this->selectedCommission,
            ]);

            //return redirect()->route('informe.show', $newreport->slug);
        }
        
        $this->modalAdd = false;
        $this->reset('report','asunto','selectedCommission');
    }

    public function delReport($id)
    {
        $this->modalDel = $id;
    }

    public function deleteReport(Report $report)
    {
        $report->delete();
        $this->modalDel = false;
    }

    public function editReport(Report $report)
    {
        $this->report = $report;
        $this->asunto = $report->asunto;
        $this->selectedCommission = $this->report->commission->id;;
        $this->modalAdd = true;
    }
}


