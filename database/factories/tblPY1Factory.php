<?php

namespace Database\Factories;

use App\Models\tblPY1;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class tblPY1Factory extends Factory
{
    protected $model = tblPY1::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'password' => bcrypt('password'), // You might want to change this for production
            'cedula' => $this->faker->unique()->numerify('##########'), // Assuming a 10-digit cedula
            'telefono' => $this->faker->phoneNumber(),
            'tipo_sangre' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
        ];
    }
}
