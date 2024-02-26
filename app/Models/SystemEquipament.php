<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemEquipament extends Model
{
    use HasFactory;

    public function equipament()
    {
        return $this->hasMany(Equipament::class);
    }
}
