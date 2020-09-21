<?php

namespace Database\Factories\Models;

use App\Models\Models\Medico;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MedicoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medico::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'crm_medico' => $this->faker->ean8+"/UF", 
            'nome_medico' => $this->faker->name, 
            'dn_medico' =>$this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
