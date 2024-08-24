<?php

namespace Database\Factories;

use App\Models\tblpedido;
use App\Models\tblcliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblpedidoFactory extends Factory
{
    protected $model = tblpedido::class;

    public function definition()
    {
        return [
            'ClienteId' => tblcliente::factory(),
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
