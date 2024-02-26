<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function servicemantenimient(){
        return $this->belongsTo(ServiceMantenimient::class);
    }

    protected $fillable = [
        'description',
        'service_mantenimient_id',
    ];

}
