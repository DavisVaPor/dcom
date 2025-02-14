<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function index(){
        return view('backend.goods');
    }

    public function almacen(){
        return view('backend.almacen');
    }

    public function show(Good $good){
        return  view('backend.good',compact('good'));
    }
}
