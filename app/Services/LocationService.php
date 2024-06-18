<?php
namespace App\Services;

use App\Models\Location;
class LocationService {
    public function __construct() {}

    public function getAll() {
        return Location::all();
    }

}