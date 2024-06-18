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

    public function show(LocationRequest $locationRequest) {
        $location = $this->locationService->getLocationById($locationRequest);

        
        // Log::info('Filtered Query:', [
        //     'output' => 'hello world',
        // ]);

        Log::info('Logging requested tickets: ' . json_encode($locationRequest));

        return inertia('Event/BookEvent', [
            'location' => $location,
        ]);
    }
}
