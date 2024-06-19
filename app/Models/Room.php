<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $with = ['location'];
    protected $fillable = [
        'location_id',
        'name',
    ];

    
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }
}
