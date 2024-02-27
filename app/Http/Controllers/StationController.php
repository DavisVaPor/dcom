<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(){
        return view('backend.estaciones');
    }

    public function show(Station $station){ 
        return  view('backend.estacion',compact('station'));
    }

}
