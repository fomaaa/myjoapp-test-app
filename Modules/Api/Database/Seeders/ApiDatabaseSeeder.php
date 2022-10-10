<?php

namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ApiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(
            [
                SeedCreateUserTableSeeder::class,
                SeedCreateVehicleTableSeeder::class
            ]
        );
    }
}
