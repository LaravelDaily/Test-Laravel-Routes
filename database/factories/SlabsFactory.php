<?php

namespace Database\Factories;

use App\Models\Slab;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SlabsFactory extends Factory
{
    protected $model = Slab::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'brand' => $this->faker->word(),
            'description' => $this->faker->text(),
            'quantity' => $this->faker->randomNumber(),
            'supplier' => $this->faker->word(),
            'order_number' => $this->faker->word(),
            'price' => $this->faker->randomFloat(),
            'polishment' => $this->faker->word(),
            'thickness' => $this->faker->randomNumber(),
            'width' => $this->faker->randomFloat(),
            'length' => $this->faker->randomFloat(),
            'square_meters' => $this->faker->randomFloat(),
            'physical_position' => $this->faker->word(),
            'image' => $this->faker->word(),
        ];
    }
}
