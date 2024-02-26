<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measuremnet extends Model
{
    use HasFactory;

    public function report(){
        return $this->belongsTo(Report::class);
    }

    public function ubigeo(){
        return $this->belongsTo(Ubigeo::class);
    }

    protected $fillable = [
        'ubicacion',
        'latitud',
        'longitud',
        'valor_rni',
        'fecha_medicion',
        'imagen',
        'report_id',
        'ubigeo_id',
    ];
}
