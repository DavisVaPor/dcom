<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Station;
use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function index()
    {
       $commissions = Commission::where('year','LIKE',date('Y'))
                                ->get();
       $estationsvhf = Station::where('sistema','LIKE','VHF')->get();

       $estationvhfDef = Station::where('sistema','LIKE','VHF')->where('estado','LIKE','OPERATIVO')->get();

       $estationshf = Station::where('sistema','LIKE','HF')->get();

       $estationhfDef = Station::where('sistema','LIKE','HF')->where('estado','LIKE','OPERATIVO')->get();

       $estationvhfDef = 100 * ($estationvhfDef->count()/$estationsvhf->count());

       $estationvhfDef = number_format($estationvhfDef,2);

       $estationhfDef = 100 * ($estationhfDef->count()/$estationshf->count());

       $estationhfDef = number_format($estationhfDef,2);

       return view('dashboard',[
            'commissions' => $commissions,
            'estationsVHF' => $estationsvhf,
            'estationvfhDef' => $estationvhfDef,
            'estationsHF' => $estationshf,
            'estationhfDef' => $estationhfDef,
       ]);
    }
}
