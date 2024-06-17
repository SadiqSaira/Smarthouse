<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
    ];
    public function device()
    {
        return $this->morphOne(Device::class, 'deviceable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($light) {
            optional($light->device)->delete();
        });
    }
}

