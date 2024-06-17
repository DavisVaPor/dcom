<?php

namespace App\Http\Controllers;

use App\Models\Ballot;
use Barryvdh\DomPDF\Facade\Pdf;


class BallotController extends Controller
{
   
    public function papeleta($num)
    {
        $ballot = Ballot::findorFail($num);

        $pdf = Pdf::loadView('reports.papeleta',compact('ballot'));
        //return view('commissionPDF',compact('commission'));
        return $pdf->download('PapeletaSalida_'.$ballot->numero.'.pdf');

    }
}
