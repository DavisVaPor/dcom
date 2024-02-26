<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimient extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'cantidad',
        'especificaciones',
        'service_mantenimient_id',
    ];
    public function servicemantenimient(){
        return $this->belongsTo(ServiceMantenimient::class);
    }

    public function producto(){
        return $this->belongsTo(CatalogoProduct::class);
    }
}
