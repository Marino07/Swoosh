<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

            //new data
            'about' => fake()->text(),
            'boosted_until' => fake()->optional()->dateTimeBetween(now(),now()->addMinutes(30)),
            'profession' => fake()->optional()->jobTitle(),
            'university' => fake()->optional()->word(),
            'city' => fake()->optional()->city(),
            'height' => fake()->optional()->randomFloat(2,150,200),
            'relationship_goals' => 'new_friends'
        ];
    }

    //configure model after seed of User

    public function configure() : static {

        return $this->afterCreating(function(User $user){
            $languages = Language::limit(rand(1,4))->inRandomOrder()->get();
            foreach ($languages as $language){
                $user->languages()->attach($language);}
        });
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
