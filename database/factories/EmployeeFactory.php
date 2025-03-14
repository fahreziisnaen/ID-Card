<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['L', 'P']);
        
        return [
            'nip' => $this->faker->unique()->numerify('################'),
            'nama' => $this->faker->name($gender == 'L' ? 'male' : 'female'),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-40 years', '-20 years'),
            'jenis_kelamin' => $gender,
            'alamat' => $this->faker->address(),
            'no_telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'jabatan' => $this->faker->randomElement([
                'Staff IT', 'Staff Keuangan', 'Staff HR', 'Manager IT', 
                'Manager Keuangan', 'Manager HR', 'Supervisor', 'Director'
            ]),
            'departemen' => $this->faker->randomElement([
                'IT', 'Keuangan', 'HR', 'Marketing', 
                'Operations', 'Sales', 'Legal'
            ]),
            'tanggal_bergabung' => $this->faker->dateTimeBetween('-5 years', 'now'),
        ];
    }
} 