<?php

namespace App\Http\Controllers;
use App\Services\LocationService;
use App\Http\Requests\LocationRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $locationService;

    public function __construct(LocationService $locationService) {
        $this->locationService = $locationService;
    }

    public function index() {
        $locations = $this->locationService->getAll();

        return Inertia::render('Locations/Index', [
            'locations' => $locations,
        ]);
    }

    public function show($id) {
        $location = $this->locationService->getLocationById($id);

        return Inertia::render('Locations/Edit', [
            'location' => $location,
        ]);
    }

    public function store(LocationRequest $locationRequest) {
        $this->locationService->add($locationRequest);

        $locations = $this->locationService->getAll();

        return Inertia::render('Locations/Index', [
            'locations' => $locations,
        ]); 
    }

    public function add() {
        return Inertia::render('Locations/Add');
    }
}
