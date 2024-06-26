<?php
namespace App\Repositories;
use App\Repositories\LocationRepositoryInterface;
use App\Models\Location;

use App\Models\Event;

class LocationRepository implements LocationRepositoryInterface{
    public function getAll() {
        $locations = Location::all();
        // Log::info('All locations', $locations);

        return $locations;
    }
    public function getLocationById($id){
        // Log::info($locationRequest['locationId']);

        $location = Location::findOrFail($id);
        return $location;
    }

    public function add($incomingFields) {

        // Log::info('Location Updated or Created:', [
        //     'location id' => $this->location->id,
        // ]);
        if($incomingFields['id']) {
            Location::updateOrCreate(
                ['id' => $incomingFields['id']],
                
                [
                'name' => $incomingFields['name'],
                'address' => $incomingFields['address'],
                ]
            );
        }
        else {
            Location::create([
                'name' => $incomingFields['name'],
                'address' => $incomingFields['address'],
            ]);
        }
        
    }
    public function delete($id){
        Location::where('id', $id)->delete();    
    }
}