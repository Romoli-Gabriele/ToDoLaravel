<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $attributes = [
            'name'=>'red',
            'team_leader_id'=>2
        ];
        $red = new Team($attributes);
        $red->save();
        
        $attributes = [
            'name'=>'blue',
            'team_leader_id'=>3
        ];
        $blue = new Team($attributes);
        $blue->save();
    }
}
