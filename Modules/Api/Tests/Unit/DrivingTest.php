<?php

namespace Modules\Api\Tests\Unit;

use Illuminate\Http\Response;
use Modules\Api\Database\Seeders\SeedCreateUserTableSeeder;
use Modules\Api\Database\Seeders\SeedCreateVehicleTableSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DrivingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $userSeed = new SeedCreateUserTableSeeder();
        $vehicleSeed = new SeedCreateVehicleTableSeeder();
        $userSeed->run();
        $vehicleSeed->run();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDriveListMethod()
    {
        $this
            ->json('GET', 'api/drive-list')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }

    public function testDrivingUserNotFound()
    {
        $this
            ->post('api/drive', [
                'user_id' => 999,
                'vehicle_id' => 1
            ])
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }

    public function testDrivingVehicleNotFound()
    {
        $this
            ->post('api/drive', [
                'user_id' => 1,
                'vehicle_id' => 999
            ])
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }

    public function testDrivingSuccess()
    {
        $this
            ->post('api/drive', [
                'user_id' => 1,
                'vehicle_id' => 1
            ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }

    public function testDrivingFail()
    {
        $this
            ->post('api/drive', [
                'user_id' => 1,
                'vehicle_id' => 1
            ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );

        $this
            ->post('api/drive', [
                'user_id' => 1,
                'vehicle_id' => 1
            ])
            ->assertStatus(Response::HTTP_NOT_ACCEPTABLE)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }

    public function testStopUserNotFound()
    {
        $this
            ->post('api/stop', [
                'user_id' => 999,
                'vehicle_id' => 1
            ])
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }

    public function testStopVehicleNotFound()
    {
        $this
            ->post('api/stop', [
                'user_id' => 999,
                'vehicle_id' => 1
            ])
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }

    public function testStopSuccess()
    {
        $this
            ->post('api/drive', [
                'user_id' => 1,
                'vehicle_id' => 1
            ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );

        $this
            ->post('api/stop', [
                'user_id' => 1,
                'vehicle_id' => 1
            ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }

    public function testStopNoActiveDriving()
    {
        $this
            ->post('api/stop', [
                'user_id' => 2,
                'vehicle_id' => 2
            ])
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }
}
