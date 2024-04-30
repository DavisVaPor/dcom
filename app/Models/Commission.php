<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'comision',
        'slug',
        'numero',
        'fecha_inicio',
        'fecha_fin',
        'periodo','year','mes','tipo','estado',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function objetives(){
        return $this->hasMany(Objetive::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function stations(){
        return $this->belongsToMany(Station::class);
    }

    public function goods(){
        return $this->belongsToMany(Good::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function ubigeo()
    {
        return $this->belongsToMany(Ubigeo::class);
    }

    public function ballot(){
        return $this->hasOne(Ballot::class);
    }
}
