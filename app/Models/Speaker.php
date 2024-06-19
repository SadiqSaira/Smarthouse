<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Speaker extends Model
{
    use HasFactory;
    protected $fillable = [
        'volume',
    ];
    public function device(): MorphOne
    {
        return $this->morphOne(Device::class, 'deviceable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($speaker) {
            optional($speaker->device)->delete();
        });
    }
}

