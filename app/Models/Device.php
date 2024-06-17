<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Device extends Model
{
    use HasFactory;
    protected $with = ['devicetype', 'room'];
    protected $fillable = [
        'devicetype_id',
        'room_id',
        'name',
    ];

    
    public function devicetype()
    {
        return $this->belongsTo(DeviceType::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function deviceable()
    {
        return $this->morphTo();
    }
    
}
