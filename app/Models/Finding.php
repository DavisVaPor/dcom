<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finding extends Model
{
    use HasFactory;

    public function report(){
        return $this->belongsTo(Report::class);
    }

    public function ubigeo(){
        return $this->belongsTo(Ubigeo::class);
    }

    protected $fillable = [
        'fechaConstatacion',
        'Radiodifusion',
        'ubigeo_id',
        'ubicacion',
        'caracteristicas',
        'imagen',
        'observaciones',
        'report_id',
    ];
}
