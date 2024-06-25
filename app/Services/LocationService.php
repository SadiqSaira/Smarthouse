<?php
namespace App\Services;

use App\Models\Location;
use App\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\Log;

class LocationService {
    protected $location;
    public function __construct(Location $location) {
        $this->location = $location;
    }

    public function getAll() {
        $locations = Location::all();
        // Log::info('All locations', $locations);

        return $locations;
    }

    public function getLocationById()
    {
        // Log::info($locationRequest['locationId']);

        $location = Location::findOrFail($this->location->id);
        return $location;
    }

    public function add() {

        // Log::info('Location Updated or Created:', [
        //     'location id' => $this->location->id,
        // ]);
        if($this->location->id) {
            Location::updateOrCreate(
                ['id' => $this->location->id],
                
                [
                'name' => $this->location->name,
                'address' => $this->location->address,
                ]
            );
        }
        else {
            Location::create([
                'name' => $this->location->name,
                'address' => $this->location->address,
            ]);
        }
        
    }
    public function delete(){
        Location::where('id', $this->location->id)->delete();    
    }

}