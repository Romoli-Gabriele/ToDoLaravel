<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use \HttpOz\Roles\Models\Role;
use App\Models\User;
use App\Models\Profile;

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
        ];
        $red = new Team($attributes);
        $red->save();
        
        $attributes = [
            'name'=>'blue',
        ];
        $blue = new Team($attributes);
        $blue->save();

        $adminRole = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        $teamLeaderRole = Role::create([
            'name' => 'Team Leader',
            'slug' => 'teamLeader',
        ]);
        $profile = [
            'cognome' => 'Romoli',
            'indirizzo' => 'Via dei PEcori 4',
            'cellulare' => '3348762090',
            'codice_fiscale' => 'rmlgrl04c11d612g',
            'sede' => 'Firenze',
            'ddn' => '2004-03-11',
            'user_id' => 1,
        ];
        $profile = new Profile($profile);
        $profile->save();
        $attributes = [
            'name'=>'Gabbo',
            'email'=>'gabbo@example.com',
            'password'=>'123456',
            'profile_id'=> 1,
            'team_id'=> null
        ];
        $attributes['password'] = bcrypt($attributes['password']);
        $admin = User::addNew($attributes);
        $admin->attachRole($adminRole);
        $admin->save();
    }
}
