<?php

namespace Database\Factories\Resources;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resources\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fake_cn = $this->fakeCompleteName();
        return [
            'name' => $fake_cn[0],
            'surname' => $fake_cn[1],
            'username' => fake()->unique()->name(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  // è l'hash di 'password'
            'gender' => array('male', 'female', 'unknown')[mt_rand(0, 2)],
            'birth' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'last_access' => now(),  // TODO: randomize last_access; potrebbe servire così come potrebbe non servire
            'removed_at' => null
        ];
    }

    private function fakeCompleteName()
    {
        return explode(' ', fake()->name());
    }
}
