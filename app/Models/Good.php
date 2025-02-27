<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected $fillable = [
        'codPatrimonio',
        'slug',
        'codigo_internoDCOM','denominacion','detalle',
        'marca','modelo','serie','color','caracteristicas','operatividad',
        'condicion','imagen','good_image_path','estado',
        'system_id','category_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function station(){
        return $this->belongsTo(Station::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
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

    public function ballots()
    {
        return $this->belongsToMany(Ballot::class);
    }
}
