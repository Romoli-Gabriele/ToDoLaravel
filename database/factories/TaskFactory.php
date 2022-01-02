<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descrizione' => $descrizione =$this->faker->sentence(),
            'terminata' => false,
            'slug'=> str_replace(' ','-',$descrizione),
            'user_id'=>rand(1,10),
        ];
    }
}
