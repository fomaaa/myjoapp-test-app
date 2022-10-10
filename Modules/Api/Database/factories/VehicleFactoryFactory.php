<?php
namespace Modules\Api\Database\factories;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Api\Entities\Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Container::getInstance()->make(Generator::class);

        return [
            "brand" => $faker->company,
            "model" => $faker->colorName,
            "number" => $faker->randomNumber(5)
        ];
    }
}

