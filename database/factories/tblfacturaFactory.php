<?php

namespace Database\Factories;

use App\Models\tblfactura;
use App\Models\tblpedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class tblfacturaFactory extends Factory
{
    protected $model = tblfactura::class;

    public function definition()
    {
        return [
            'PedidoId' => tblpedido::factory(),
            'monto_total' => $this->faker->randomFloat(2, 10, 1000),
            'fecha_emision' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
