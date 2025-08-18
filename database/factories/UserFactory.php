<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
            'name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->word()),
            'division_id' => Division::all()->random()->id,
            'role_id' => UserRole::all()->random()->id,
            'email_verified_at' => rand(0,1) === 1 ? now() : null,
        ];
    }
}
