<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Device extends Model
{
    use HasFactory;
    protected $with = ['devicetype', 'room'];
    protected $fillable = [
        'devicetype_id',
        'room_id',
        'name',
    ];

    
    public function devicetype(): BelongsTo
    {
        return $this->belongsTo(DeviceType::class);
    }
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
    public function deviceable(): MorphTo
    {
        return $this->morphTo();
    }
    
}
