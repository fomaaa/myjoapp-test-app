<?php

namespace Modules\Api\Database\Seeders;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Entities\User;
use Modules\Api\Entities\Vehicle;

class SeedCreateUserTableSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }
    /**
     * Get a new Faker instance.
     *
     * @return Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::factory()
            ->count(10)
            ->create();
    }
}
