<?php

namespace Database\Factories;

use App\Models\tblarticulo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblarticuloFactory extends Factory
{
    protected $model = tblarticulo::class;

    public function definition()
    {
        return [
            'codigo_barras' => $this->faker->ean13,
            'descripcion' => $this->faker->sentence,
            'fabricante' => $this->faker->company,
        ];
    }
}
