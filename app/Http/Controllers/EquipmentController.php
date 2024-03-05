<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(){
        return view('backend.equipments');
    }

    public function show(Equipment $estation){ 
        return  view('backend.equipment',compact('estation'));
    }
}
