<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'telefono',
    ];

    public function estation()
    {
        return $this->hasMany(Station::class);
    }
    
}
