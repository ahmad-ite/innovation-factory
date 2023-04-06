<?php

namespace Database\Factories;

use App\Enums\User\UserPrefixnameEnum;
use App\Enums\User\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'prefixname' => UserPrefixnameEnum::getRandomValue(),
            'firstname' => fake()->firstName(),
            'middlename' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'suffixname' => null,
            'username' => fake()->unique()->userName(),
            'type' => UserTypeEnum::getRandomValue(),
            'email_verified_at' => now(),
            'password' => config('default.admin.password'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}