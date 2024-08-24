<?php

namespace Database\Factories;

use App\Models\tblcliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblclienteFactory extends Factory
{
    protected $model = tblcliente::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'telefono' => $this->faker->phoneNumber,
            'tipo_cliente' => $this->faker->randomElement(['regular', 'vip', 'nuevo']),
        ];
    }
}