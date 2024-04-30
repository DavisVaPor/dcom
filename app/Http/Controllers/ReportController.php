<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index(){
        return view('backend.reports');
    }

    public function show(Report $informe){
        return  view('backend.report',compact('informe'));
    }

    public function reporte(Report $informe )
    {
        $pdf = PDF::loadView('reportes.informes',compact('informe'));
        //return view('reportes.informes',compact('informe'));
        return $pdf->download($informe->asunto.'.pdf');
    }
}
