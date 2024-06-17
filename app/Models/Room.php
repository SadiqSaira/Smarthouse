<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
    use HasFactory;
    protected $with = ['location'];
    protected $fillable = [
        'location_id',
        'name',
    ];

    
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
