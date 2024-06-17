<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thermostat extends Model
{
    use HasFactory;
    protected $fillable = [
        'current_temperature',
    ];
    public function device()
    {
        return $this->morphMany(Device::class, 'deviceable');
    }
}

