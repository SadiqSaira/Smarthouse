<?php
namespace App\Services;

use App\Models\Room;
use App\Http\Requests\RoomRequest;
use Illuminate\Support\Facades\Log;

class RoomService implements RoomServiceInterface{
    public function __construct() {}

    public function getRoomsByLocationId($location_id) {
        $rooms = Room::where('location_id', $location_id)->get();
        // Log::info('All locations', $locations);

        return $rooms;
    }

    public function getRoomById($id)
    {
        // Log::info($locationRequest['locationId']);

        $room = Room::findOrFail($id);
        return $room;
    }

    public function add(RoomRequest $roomRequest) {

        // Log::info('Location Updated or Created:', [
        //     'location id' => $locationRequest['id'],
        // ]);
        Room::updateOrCreate(
            ['id' => (int)$roomRequest['id']],
            
            [
            'name' => $roomRequest['name'],
            'location_id' => $roomRequest['location_id'],
            ]
    );
    }
    public function delete(RoomRequest $roomRequest){
        Room::where('id', $roomRequest['id'])->delete();    
    }

}