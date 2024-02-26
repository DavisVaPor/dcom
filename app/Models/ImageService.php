<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageService extends Model
{
    use HasFactory;

    public function servicemantenimient(){
        return $this->belongsTo(ServiceMantenimient::class);
    }

    protected $fillable = [
        'name',
        'image',
        'service_mantenimient_id',
    ];
}
