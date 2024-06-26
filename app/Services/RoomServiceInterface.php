<?php

namespace App\Services;
use App\Http\Requests\RoomRequest;

interface RoomServiceInterface
{
    public function getRoomsByLocationId($location_id);
    public function getRoomById($id);
    public function add(RoomRequest $roomRequest);
    public function delete(RoomRequest $roomRequest);
}