<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    use HasFactory;

    public function estation()
    {
        return $this->hasMany(Station::class);
    }

    public function commissions()
    {
        return $this->belongsToMany(Commission::class);
    }

    public function measurements()
    {
        return $this->hasMany(Measuremnet::class);
    }

    public function findings()
    {
        return $this->hasMany(Finding::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
