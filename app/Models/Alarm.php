<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Alarm extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
    ];
    public function device(): MorphOne
    {
        return $this->morphOne(Device::class, 'deviceable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($alarm) {
            optional($alarm->device)->delete();
        });
    }
}

