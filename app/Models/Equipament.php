<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipament extends Model
{
    use HasFactory;
    protected $fillable = [
        'codPatrimonio',
        'codigo_internoDCOM','denominacion','detalle',
        'marca','modelo','serie','color','caracteristicas','operatividad',
        'situacion','condicion','imagen','equipment_image_path','estado',
        'station_id','system_id','category_id',
    ];
    public function estation(){
        return $this->belongsToMany(Station::class);
    }

    public function system()
    {
        return $this->belongsTo(SystemEquipament::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function commissions()
    {
        return $this->belongsToMany(Commission::class);
    }

    public function movimients(){
        return $this->hasMany(Movimient::class);
    }

    public function observations(){
        return $this->hasMany(Observation::class);
    }

    public function mantenimients(){
        return $this->hasMany(Maintenance::class);
    }
}
