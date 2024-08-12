<?php

namespace TheBachtiarz\Config\Models\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use TheBachtiarz\Config\Models\Config;

/**
 * @extends Factory<Config>
 */
class ConfigFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Config::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Config::ATTRIBUTE_PATH => Str::uuid()->toString(),
            Config::ATTRIBUTE_IS_ENCRYPT => true,
            Config::ATTRIBUTE_VALUE => fake()->sentence(),
        ];
    }
}
