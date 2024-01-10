<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

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
    public function definition()
    {
        $country = Country::inRandomOrder()->first();
        $state = State::where('country_id', $country->id)->inRandomOrder()->first();

        return [
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$NQNvt1CF8QMJ.AO7X..rW.uiA8.CwFPw8ZrBW0L5MqCGHYsrNIPS2', // 123@User
            'remember_token' => Str::random(10),
            'country' => $country->id,
            'state' => $state->id,
            'city' => fake()->city(),
            'zip' => fake()->postcode(),
            'profile_path' => 'profile-photos/profile_photo_default.jpg',
            'interest' => implode(',,', $this->getInterests()),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Simulate photo upload and store file paths in the database.
     *
     * @return array
     */
    public function getInterests()
    {
        $interests = ['reading', 'writing', 'traveling', 'playing'];

        // Shuffle the array
        shuffle($interests);

        return array_slice($interests, 0, 2);
    }
}
