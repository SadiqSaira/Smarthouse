<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
    ];
    public function device()
    {
        return $this->morphMany(Device::class, 'deviceable');
    }
}

