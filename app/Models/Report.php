<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
        'anho',
        'slug',
        'asunto',
        'fechaCreacion',
        'estado',
        'commission_id',
    ];
    public function commission(){
        return $this->belongsTo(Commission::class);
    }

    public function servicemantenimiento(){
        return $this->hasMany(ServiceMantenimient::class);
    }

    public function measurements(){
        return $this->hasMany(Measuremnet::class);
    }

    public function findings()
    {
        return $this->hasMany(Finding::class);
    }
   
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
