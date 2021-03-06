<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Team extends Model
{
    use HasFactory;

    public function members(){
        return $this->hasMany(User::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
