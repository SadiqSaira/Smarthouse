<?php
namespace Tests\Feature\Services;

use App\Services\RoomService;
use App\Services\LocationService;
use Tests\TestCase;
use App\Models\Location;
use App\Models\Room;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\LocationRequest;
use App\Repositories\LocationRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
//
class RoomServiceTest extends TestCase
{
    use RefreshDatabase;
    
  
    private $roomService;
    private $locationService;

    private $locationRepository;
    private $location;

    protected function setUp(): void
    {
        parent::setUp();
        $this->roomService = new RoomService();
        $this->locationRepository = new LocationRepository();
        $this->locationService = new LocationService($this->locationRepository);
        $this->createLocation();
    }
    public function createLocation(){
        $locationRequest = new LocationRequest(['name' => 'Test Location 1',
                                                'address' => 'Test address 1',
                                               ]);
        $this->locationService->add($locationRequest);
        $this->location = Location::first();
    }


    public function test_it_can_add_a_room()
    {

        // Assert the location was created
        $this->assertDatabaseHas('locations', ['id' => $this->location->id,
                                                'name' => 'Test Location 1',
                                                'address' => 'Test address 1',
                                              ]);

        // Create room request
        $roomRequest = new RoomRequest(['name' => 'Test Room',
                                        'location_id' => $this->location->id,
                                       ]);
        
        // Add room
        $this->roomService->add($roomRequest);
        $room = Room::first(); 

        // Assert the room was created
        $this->assertDatabaseHas('rooms', ['id' => $room->id,
                                            'name' => 'Test Room',
                                            'location_id' => $this->location->id,
                                          ]);

        $this->refreshDatabase();
    }
    public function test_it_can_update_a_room(){

        // Create room request
        $roomRequest = new RoomRequest(['name' => 'Test Room',
                                        'location_id' => $this->location->id,
                                       ]);
        Log::info('Updating room with request:', $roomRequest->all());

        // Add room
        $this->roomService->add($roomRequest);
        $room = Room::first(); 
        $roomRequest = new RoomRequest(['id' => $room->id,
                                        'name' => 'Test Room update',
                                        'location_id' => $this->location->id,
                                       ]);
        $this->roomService->add($roomRequest);
        // Assert the room was created
        $this->assertDatabaseHas('rooms', ['id' => $room->id,
                                            'name' => 'Test Room update',
                                            'location_id' => $this->location->id,
                                          ]);

    }
    public function test_it_can_delete_a_room(){

        // Create room request
        $roomRequest = new RoomRequest([ 'name' => 'Test Room',
                                         'location_id' => $this->location->id,
                                       ]);

        // Add room
        $this->roomService->add($roomRequest);
        //get the recently created room
        $room = Room::first(); 

        Room::where('id', $room->id)->delete();
        
        // Assert the room was created
        $this->assertDatabaseMissing('rooms', [
            'id' => $room->id,
        ]);

    }
    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
