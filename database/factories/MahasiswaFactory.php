<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nim' => $this->faker->unique()->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail(),
            'jurusan' => $this->faker->randomElement(['Teknik Informatika', 'Teknik Industri', 'Teknik Elektro', 'Teknik Mesin']),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->phoneNumber(),
            'foto' => $this->faker->imageUrl(640, 480, 'people', true)
        ];
    }
}
