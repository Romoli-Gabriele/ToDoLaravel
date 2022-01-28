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
            'team_id' => $team_id = rand(1,2),
            'user_id'=> $user_id = rand(1,4),
        ];
    }
}
