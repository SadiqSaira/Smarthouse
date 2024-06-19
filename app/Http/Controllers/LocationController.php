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

    public function __construct(LocationService $locationService, RoomService $roomService) {
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
        $rooms = $this->roomService->getRoomsByLocationId($id);

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
        $this->locationService->add($locationRequest);

        $locations = $this->locationService->getAll();

        return Inertia::location(route('location.index')); 
    }

    public function add() {
        return Inertia::render('Locations/Add');
    }

    public function delete(LocationRequest $locationRequest){
        Location::where('id', $locationRequest['id'])->delete();    

        Log::info('Here I am');
        Log::info(Location::find($locationRequest['id']));
        $this->index();
    }
}
