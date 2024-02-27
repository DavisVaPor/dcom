<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'comision',
        'numero',
        'fecha_inicio',
        'fecha_fin',
        'periodo','year','mes','tipo','estado',
    ];

    public function objetives(){
        return $this->hasMany(Objetive::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function estations(){
        return $this->belongsToMany(Station::class);
    }

    public function equipaments(){
        return $this->belongsToMany(Equipament::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function ubigeo()
    {
        return $this->belongsToMany(Ubigeo::class);
    }
}
