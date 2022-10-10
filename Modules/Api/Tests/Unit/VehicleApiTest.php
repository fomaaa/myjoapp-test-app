<?php

namespace Modules\Api\Tests\Unit;

use Illuminate\Http\Response;
use Modules\Api\Database\Seeders\SeedCreateUserTableSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $userSeed = new SeedCreateUserTableSeeder();
        $userSeed->run();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testVehicleList()
    {
        $this
            ->json('GET', 'api/vehicle')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data',
                    'message'
                ]
            );
    }
}
