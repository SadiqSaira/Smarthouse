<?php

namespace App\Http\Controllers;
use App\Services\RoomService;
use App\Http\Requests\RoomRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $roomService;

    public function __construct(RoomService $roomService) {
        $this->roomService = $roomService;
    }

    public function index($id) {
        $rooms = $this->roomService->getRoomsByLocationId($id);

        return Inertia::render('Rooms/Index', [
            'rooms' => $rooms,
        ]);
    }

    public function show($id) {
        $room = $this->roomService->getRoomById($id);

        return Inertia::render('Rooms/Edit', [
            'room' => $room,
        ]);
    }

    public function store(RoomRequest $roomRequest) {
        $this->roomService->add($roomRequest);
    }
}
