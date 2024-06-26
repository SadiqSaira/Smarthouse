<?php

namespace Tests\Feature\Repositories;

use Tests\TestCase;
use App\Models\Location;
use App\Repositories\LocationRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $locationRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->locationRepository = new LocationRepository();
    }

    public function test_it_can_get_all_locations()
    {
        Location::factory()->count(2)->create();

        $locations = $this->locationRepository->getAll();

        $this->assertCount(2, $locations);
    }

    public function test_it_can_get_location_by_id()
    {
        $location = Location::factory()->create();

        $foundLocation = $this->locationRepository->getLocationById($location->id);

        $this->assertEquals($location->id, $foundLocation->id);
    }

    
    public function test_it_can_update_location_with_id()
    {
        $location = Location::factory()->create(['name' => 'Location 1',
                                                 'address' => 'Address 1',
                                                ]);

        $incomingFields = ['id' => $location->id,
                           'name' => 'Updated Location 1',
                           'address' => 'Updated Address 1',
                          ];

        $this->locationRepository->add($incomingFields);

        $updatedLocation = Location::find($location->id);

        $this->assertEquals('Updated Location 1', $updatedLocation->name);
        $this->assertEquals('Updated Address 1', $updatedLocation->address);
    }

    public function test_it_can_add_new_location()
    {
        $incomingFields = ['id' => '',
                           'name' => 'New Location',
                           'address' => 'New Address',
                          ];

        $this->locationRepository->add($incomingFields);
        $locations = $this->locationRepository->getAll();

        $location = $locations->first();

        $this->assertNotNull($location);
        $this->assertEquals('New Location', $location->name);
        $this->assertEquals('New Address', $location->address);
    }

    public function test_it_can_delete_location()
    {
        $location = Location::factory()->create();

        $this->locationRepository->delete($location->id);

        $this->assertNull(Location::find($location->id));
    }
    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
