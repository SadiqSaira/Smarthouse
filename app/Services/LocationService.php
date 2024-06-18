<?php
namespace App\Services;

use App\Models\Location;
use App\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\Log;

class LocationService {
    public function __construct() {}

    public function getAll() {
        $locations = Location::all();
        // Log::info('All locations', $locations);

        return $locations;
    }

    public function getLocationById($id)
    {
        // Log::info($locationRequest['locationId']);

        $location = Location::findOrFail($id);
        return $location;
    }

    public function add(LocationRequest $locationRequest) {

        // Log::info('Location Updated or Created:', [
        //     'location id' => $locationRequest['id'],
        // ]);
        Location::updateOrCreate(
            ['id' => (int)$locationRequest['id']],
            
            [
            'name' => $locationRequest['name'],
            'address' => $locationRequest['address'],
            ]
    );
    }

}