<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'paternal_surname' => $this->faker->lastName,
            'maternal_surname' => $this->faker->lastName,
            'avatar'=> 'https://api.dicebear.com/7.x/miniavs/svg?seed='. Str::random(10),
            'email_verified_at' => now(),
            'date_birthday' => $this->faker->date($format = 'Y-m-d', $max = '2000-01-01'),
            'age' => $this->faker->numberBetween($min = 18, $max = 70), 
            'sex'=> 'men',
            'phone_number' => $this->faker->phoneNumber,
            'password' => bcrypt('123456789'),
            'remember_token' => Str::random(10),
        ];
    }
    
    public function teacher()
    {
        return $this->state([
            'rol' => 'teacher',
            'email' => 'maestro@gmail.com',
        ]);
    }

    public function student()
    {
        return $this->state([
            'rol' => 'student',
            'email' => 'estudiante@gmail.com',
        ]);
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
