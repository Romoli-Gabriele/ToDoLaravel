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
            'team_leader'=>1
        ];
        $red = new Team($attributes);
        $red->save();
        
        $attributes = [
            'name'=>'blue',
            'team_leader'=>2
        ];
        $blue = new Team($attributes);
        $blue->save();
    }
}
