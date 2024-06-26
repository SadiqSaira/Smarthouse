<?php
namespace App\Services;

use App\Models\Location;
use App\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\Log;
use App\Repositories\LocationRepositoryInterface;
use App\Repositories\LocationRepository;
class LocationService implements LocationServiceInterface{
    private $locationRepository;
    public function __construct(LocationRepositoryInterface $locationRepository ) {
        $this->locationRepository = $locationRepository;
    }

    public function getAll() {
        return $locations = $this->locationRepository->getAll();
    }

    public function getLocationById($id)
    {
        return $locations = $this->locationRepository->getLocationById($id);
    }

    public function add($incomingFields) {
        return $locations = $this->locationRepository->add($incomingFields);
        
    }
    public function delete($id){
        return $locations = $this->locationRepository->delete($id);
    }

}