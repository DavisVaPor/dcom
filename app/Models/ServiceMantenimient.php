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
        'diagnostico',
        'acciones',
        'report_id',
    ];

    public function estation(){
        return $this->belongsTo(Station::class);
    }

    public function report(){
        return $this->belongsTo(Report::class);
    }

    public function images(){
        return $this->hasMany(ImageService::class);
    }

    public function requerimient(){
        return $this->hasMany(Requerimient::class);
    }

    public function activities(){
        return $this->hasMany(Activity::class);
    }

    public function actas(){
        return $this->hasMany(Acta::class);
    }

    public function movimients(){
        return $this->hasMany(Movimient::class);
    }

    public function observations(){
        return $this->hasMany(Observation::class);
    }
}
