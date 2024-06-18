<?php

namespace App\Http\Controllers;
use App\Services\LocationService;
use App\Models\Location;
use Inertia\Inertia;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $locationService;

    public function __construct(LocationService $locationService) {
        $this->locationService = $locationService;
    }

    public function index() {
        // $locations = $this->locationService->getAll();

        return Inertia::render('Locations/Index', [
            'locations' => Location::all(),
        ]);
    }
}
