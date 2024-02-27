<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'codestation',
        'tipoPy',
        'latitud',
        'longitud',
        'altitud',
        'url_maps',
        'frec_canal',
        'frec_fm',
        'estado',
        'energia',
        'caseta','caseta_estado','situacion','sistema','tipo',
        'image_caseta','image_panoramica','image_torre','manager_id',
        'ultima_visita','ubigeo_id',
    ];

    public function ubigeo()
    {
        return $this->belongsTo(Ubigeo::class);
    }

    public function manager()
    {
        return $this->belongsTo(StationManager::class);
    }

    public function commissions()
    {
        return $this->belongsToMany(Commission::class);
    }

    public function servicemantenimiento(){
        return $this->hasMany(ServiceMantenimient::class);
    }
}
