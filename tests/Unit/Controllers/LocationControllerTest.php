<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Http\Controllers\LocationController;
use App\Services\LocationServiceInterface;
use App\Services\RoomServiceInterface;
use Illuminate\Http\Request;
use Mockery;
use App\Models\Location;
use App\Models\Room;
use App\Http\Resources\LocationResource;
use App\Http\Requests\LocationRequest;
use Inertia\Inertia;
use Inertia\Response;

class LocationControllerTest extends TestCase
{
    protected $locationServiceMock;
    protected $roomServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->locationServiceMock = Mockery::mock(LocationServiceInterface::class);
        $this->roomServiceMock = Mockery::mock(RoomServiceInterface::class);

        $this->app->instance(LocationServiceInterface::class, $this->locationServiceMock);
        $this->app->instance(RoomServiceInterface::class, $this->roomServiceMock);
    }

    public function test_index()
    {
        $locations = collect([
            new Location(['name' => 'Test Location 1', 
                          'address' => '123 Main St'
                        ]),
            new Location(['name' => 'Test Location 2', 
                          'address' => '456 Main St'
                        ]),
        ]);

        $this->locationServiceMock
            ->shouldReceive('getAll')
            ->once()
            ->andReturn($locations);

        $controller = new LocationController($this->roomServiceMock, $this->locationServiceMock);

        $response = $controller->index();
        $responsenew = $response->toResponse(new Request());

        $this->assertEquals(200, $responsenew->getStatusCode());

        $responseData = $responsenew->original;
        $page = $responseData['page'];

        $this->assertEquals('Locations/Index', $page['component']);
        $this->assertCount(2, $page['props']['locations']);
    }

    public function test_show_location_by_id()
    {
        $location = new Location(['id' => 1,
                                  'name' => 'Test Location 1', 
                                  'address' => '123 Main St'
                                ]);


        $rooms = collect([
            new Room(['name' => 'Room 1', 'location_id' => 1]),
            new Room(['name' => 'Room 2', 'location_id' => 1]),
        ]);

        $this->locationServiceMock
            ->shouldReceive('getLocationById')
            ->once()
            ->with(1)
            ->andReturn($location);

        $this->roomServiceMock
            ->shouldReceive('getRoomsByLocationId')
            ->once()
            ->with($location['id'])
            ->andReturn($rooms);

        $controller = new LocationController($this->roomServiceMock, $this->locationServiceMock);

        $response = $controller->show(1);
        $responsenew = $response->toResponse(new Request());

        $this->assertEquals(200, $responsenew->getStatusCode());

        $responseData = $responsenew->original;
        $page = $responseData['page'];


        $this->assertEquals('Locations/View', $page['component']);
        $this->assertEquals($location->toArray(), $page['props']['location']);
        $this->assertCount(2, $page['props']['rooms']);
    }

    public function test_edit_location_by_id()
    {
        $location = new Location(['id' => 1,
                                  'name' => 'Test Location 1', 
                                  'address' => '123 Main St'
                                ]);

        $this->locationServiceMock
            ->shouldReceive('getLocationById')
            ->once()
            ->with(1)
            ->andReturn($location);

        $controller = new LocationController($this->roomServiceMock, $this->locationServiceMock);

        $response = $controller->edit(1);
        $responsenew = $response->toResponse(new Request());

        $this->assertEquals(200, $responsenew->getStatusCode());

        $responseData = $responsenew->original;
        $page = $responseData['page'];

        $this->assertEquals('Locations/Edit', $page['component']);
        $this->assertEquals($location->toArray(), $page['props']['location']);
    }

    public function test_store_location()
    {
        $request = new LocationRequest([
            'id' => 1,
            'name' => 'Test Location 1',
            'address' => '123 Main St',
        ]);

        $incomingFields = [
            'id' => 1,
            'name' => 'Test Location 1',
            'address' => '123 Main St',
        ];

        $this->locationServiceMock
            ->shouldReceive('add')
            ->once()
            ->with($incomingFields);

        $locations = collect([
            new Location(['name' => 'Test Location 1', 'address' => '123 Main St']),
            new Location(['name' => 'Test Location 2', 'address' => '456 Elm St']),
        ]);

        $this->locationServiceMock
            ->shouldReceive('getAll')
            ->once()
            ->andReturn($locations);

        $controller = new LocationController($this->roomServiceMock, $this->locationServiceMock);

        $response = $controller->store($request);

        $this->assertEquals(302, $response->getStatusCode());
        
        $this->assertEquals(route('location.index'), $response->headers->get('Location'));

        
    }

    public function test_add_location()
    {
        $controller = new LocationController($this->roomServiceMock, $this->locationServiceMock);

        $response = $controller->add();
        $responsenew = $response->toResponse(new Request());

        $this->assertEquals(200, $responsenew->getStatusCode());

        $responseData = $responsenew->original;
        $page = $responseData['page'];

        $this->assertEquals('Locations/Add', $page['component']);
    }

    public function test_delete_location_by_id()
    {
        $this->locationServiceMock
            ->shouldReceive('delete')
            ->once()
            ->with(1);

        $controller = new LocationController($this->roomServiceMock, $this->locationServiceMock);

        $controller->delete(1);

        $this->locationServiceMock->shouldHaveReceived('delete')->with(1)->once();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
