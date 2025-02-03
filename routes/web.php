<?php

use App\Http\Controllers\BallotController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('auth.login');})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
});


Route::middleware(['auth:sanctum', 'verified'])->get('/comisiones',[CommissionController::class , 'index'] )->name('commissions');

Route::middleware(['auth:sanctum', 'verified'])->get('/comision/{commission}', [CommissionController::class , 'show'])->name('commision.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/estaciones',[StationController::class , 'index'] )->name('estaciones');

Route::middleware(['auth:sanctum', 'verified'])->get('/estacion/{estation}',[StationController::class , 'show'] )->name('estacion.show');

//Route::middleware(['auth:sanctum', 'verified'])->get('/estacion/PDF/{estation}', [StationController::class,'report'])->name('estationpdf');

Route::middleware(['auth:sanctum', 'verified'])->get('/inventario',[GoodController::class , 'index'] )->name('equipos');

Route::middleware(['auth:sanctum', 'verified'])->get('/almacen',[GoodController::class , 'almacen'] )->name('almacen');

Route::middleware(['auth:sanctum', 'verified'])->get('/equipo/{good}',[GoodController::class , 'show'] )->name('equipo.show');


Route::middleware(['auth:sanctum', 'verified'])->get('/comision/report/{commission}', [CommissionController::class,'report'])->name('commisionpdf');

Route::middleware(['auth:sanctum', 'verified'])->get('/papeleta/report/{ballot}', [BallotController::class,'papeleta'])->name('papeletapdf');


Route::middleware(['auth:sanctum', 'verified'])->get('/informes',[ReportController::class , 'index'] )->name('informes');

Route::middleware(['auth:sanctum', 'verified'])->get('/informe/{informe}',[ReportController::class , 'show'] )->name('informe');

