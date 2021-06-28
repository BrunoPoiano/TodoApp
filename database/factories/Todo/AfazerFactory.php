<?php

namespace Database\Factories\Todo;

use App\Models\Todo\Afazer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AfazerFactory extends Factory
{

    protected $model = Afazer::class;

    public function definition()
    {
        return [
            'afazer' => $this->faker->text(5),
            'prioridade' => $this->faker->numberBetween(1,3),
        ];
    }
}
