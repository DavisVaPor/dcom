<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
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
        'tema',
        'descripcion',
        'imagen_evidencia',
        'report_id',
        'ubigeo_id',
    ];
}
