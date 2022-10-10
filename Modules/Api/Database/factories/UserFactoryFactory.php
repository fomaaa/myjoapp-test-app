<?php
namespace Modules\Api\Database\factories;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Api\Entities\User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Container::getInstance()->make(Generator::class);

        return [
            "name" => $faker->firstNameMale,
        ];
    }
}

