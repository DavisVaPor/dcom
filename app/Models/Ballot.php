<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'numero',
        'year',
        'commission_id',
        
    ];

    public function goods(){
        return $this->belongsToMany(Good::class);
    }

    public function commission(){
        return $this->belongsTo(Commission::class);
    }
}
