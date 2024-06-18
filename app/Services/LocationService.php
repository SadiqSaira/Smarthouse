<?php
namespace App\Services;

use App\Models\Location;
use App\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\Log;

class LocationService {
    public function __construct() {}

    public function getAll() {
        return Location::all();
    }

    public function getLocationById(LocationRequest $locationRequest)
    {
        Log::info($locationRequest['locationId']);

        $location = Location::findOrFail($locationRequest['locationId']);
        return $location;
    }

}