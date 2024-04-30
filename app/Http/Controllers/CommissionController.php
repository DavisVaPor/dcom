<?php

namespace App\Http\Controllers;

use App\Models\Ballot;
use App\Models\Commission;
use Barryvdh\DomPDF\Facade\Pdf;

class CommissionController extends Controller
{
    public function index(){
        return view('backend.commissions');
    }

    public function show(Commission $commission){
        return  view('backend.commission',compact('commission'));
    }

    public function report(Commission $commission)
    {
        $pdf = Pdf::loadView('reports.commission',compact('commission'));
        //return view('commissionPDF',compact('commission'));
        return $pdf->download($commission->slug.'.pdf');

    }

    
}
