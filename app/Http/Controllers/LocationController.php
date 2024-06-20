<?php

namespace App\Http\Controllers;
use App\Services\LocationService;
use App\Services\RoomService;
use App\Http\Requests\LocationRequest;
use Inertia\Inertia;
use App\Models\Location;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $locationService;
    private $roomService;
    private $location;
    public function __construct() {

    }

    public function index() {

        $this->locationService = new LocationService(new Location());
        $locations = $this->locationService->getAll();

        return Inertia::render('Locations/Index', [
            'locations' => $locations,
        ]);
    }

    public function show($id) {
        $this->createLocationFromId($id);
        $this->roomService = new RoomService();
        
        $location = $this->locationService->getLocationById();
        $rooms = $this->roomService->getRoomsByLocationId($location->id);

        return Inertia::render('Locations/View', [
            'location' => $location,
            'rooms' => $rooms,
        ]);
    }

    public function edit($id) {
        $this->createLocationFromId($id);

        $location = $this->locationService->getLocationById();

        return Inertia::render('Locations/Edit', [
            'location' => $location,
        ]);
    }

    public function store(LocationRequest $locationRequest) {
        
        $this->createLocationFromRequest($locationRequest);

        $this->locationService->add();

        $locations = $this->locationService->getAll();

        return Inertia::location(route('location.index')); 
    }

    public function add() {
        return Inertia::render('Locations/Add');
    }

    public function delete(LocationRequest $locationRequest){
        
        $this->createLocationFromRequest($locationRequest);
        $this->locationService->delete();  

        // Log::info('Here I am');
        // Log::info(Location::find($locationRequest['id']));
        $this->index();
    }

    public function createLocationFromRequest(LocationRequest $locationRequest){
        $this->location = new Location();
        $this->location->id = $locationRequest['id'];
        $this->location->name = $locationRequest['name'];
        $this->location->address = $locationRequest['address'];
        $this->locationService = new LocationService($this->location);
    }
    public function createLocationFromId($id){
        $this->location = new Location();
        $this->location->id = $id;
        $this->locationService = new LocationService($this->location);
    }
}
