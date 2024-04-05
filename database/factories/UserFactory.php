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
        $arrayImageCover = [
            'https://th.bing.com/th/id/OIP.73Lcgf8QZLbPKSN29gPuXQHaBe?rs=1&pid=ImgDetMain',
            'https://cdn.statically.io/img/timelinecovers.pro/facebook-cover/download/ultra-hd-stars-facebook-cover.jpg',
            'https://th.bing.com/th/id/OIP.hXJ4lT8pFi5hXI56W5z77wHaE8?rs=1&pid=ImgDetMain',
            'https://th.bing.com/th/id/OIP.CPU7UvkWzEDJPOm83SMmqAHaCe?rs=1&pid=ImgDetMain',
            'https://th.bing.com/th/id/OIP.uzF4QTUsVM7wXSKL-6bF6AHaCe?rs=1&pid=ImgDetMain',
            'https://i.pinimg.com/originals/aa/96/94/aa9694d4a2e2db1a5dfbabac200cc349.png'
        ];
        return [
            'name' => $this->faker->name,
            'paternal_surname' => $this->faker->lastName,
            'maternal_surname' => $this->faker->lastName,
            'avatar'=> 'https://api.dicebear.com/7.x/miniavs/svg?seed='. Str::random(10),
            'email_verified_at' => now(),
            'date_birthday' => $this->faker->date($format = 'Y-m-d', $max = '2000-01-01'),
            'image_cover' =>$arrayImageCover[array_rand($arrayImageCover)],
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
