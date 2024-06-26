<?php

namespace App\Http\Controllers;
use App\Services\LocationServiceInterface;
use App\Services\RoomServiceInterface;
use App\Services\RoomService;
use App\Http\Requests\LocationRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $locationService;
    private $roomService;
    public function __construct(RoomServiceInterface $roomService, LocationServiceInterface $locationService) {
        $this->locationService = $locationService;
        $this->roomService = $roomService;
    }

    public function index() {


        $locations = $this->locationService->getAll();

        return Inertia::render('Locations/Index', [
            'locations' => $locations,
        ]);
    }

    public function show($id) {
        
        $location = $this->locationService->getLocationById($id);
        $rooms = $this->roomService->getRoomsByLocationId($location->id);

        return Inertia::render('Locations/View', [
            'location' => $location,
            'rooms' => $rooms,
        ]);
    }

    public function edit($id) {

        $location = $this->locationService->getLocationById($id);

        return Inertia::render('Locations/Edit', [
            'location' => $location,
        ]);
    }

    public function store(LocationRequest $locationRequest) {
        $incomingFields = [];
        $incomingFields['id'] = $locationRequest['id'];
        $incomingFields['name'] = $locationRequest['name'];
        $incomingFields['address'] = $locationRequest['address'];

        $this->locationService->add($incomingFields);

        $locations = $this->locationService->getAll();

        return Inertia::location(route('location.index')); 
    }

    public function add() {
        return Inertia::render('Locations/Add');
    }

    public function delete($id){
        $this->locationService->delete($id);
        // Location::where('id', $id)->delete();    
    }


}
