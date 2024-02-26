<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoProduct extends Model
{
    use HasFactory;

    public function requerimient(){
        return $this->hasMany(Requerimient::class);
    }
}
