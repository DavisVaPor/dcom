<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMantenimient extends Model
{
    use HasFactory;
    protected $fillable = [
        'servicio',
        'fechaServicio',
        'station_id',
        'report_id',
    ];

    public function estation(){
        return $this->belongsTo(Station::class);
    }

    public function report(){
        return $this->belongsTo(Report::class);
    }

    public function image(){
        return $this->hasMany(ImageService::class);
    }

    public function requerimient(){
        return $this->hasMany(Requerimient::class);
    }

    public function activities(){
        return $this->hasMany(Activity::class);
    }

    public function acta(){
        return $this->hasMany(Acta::class);
    }

    public function movimients(){
        return $this->hasMany(Movimient::class);
    }
}
