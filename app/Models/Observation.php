<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    public function servicemantenimient(){
        return $this->belongsTo(ServiceMantenimient::class);
    }

    public function good()
    {
        return $this->belongsTo(Good::class);
    }

    protected $fillable = [
        'description',
        'service_mantenimient_id',
        'nivel',
    ];
}
