<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    public function equipament(){
        return $this->belongsTo(Equipament::class);
    }

    protected $fillable = [
        'fechamantenimiento',
        'actividades',
        'estado_old',
        'estado_now',
        'equipment_id',
    ];
}
