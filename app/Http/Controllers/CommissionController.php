<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(){
        return view('backend.commissions');
    }

    public function show(Commission $commission){
        return  view('backend.commission',compact('commission'));
    }
}
