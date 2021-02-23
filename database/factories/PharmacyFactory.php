<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pharmacy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone_number' => $this->faker->unique()->safeEmail,
            'location'    => Str::random(10),
            'notes'    => Str::random(10),
            'latitude' =>  $this->faker->randomElement([3, 4, 5]),
            'longitude' =>  $this->faker->randomElement([3, 4, 5]),
            'is_active' =>  $this->faker->randomElement([0, 1]),
            'is_special' =>  $this->faker->randomElement([0, 1]),
            'city_id' =>  $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]),
        ];
    }
}
