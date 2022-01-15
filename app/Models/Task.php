<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    public static function addNew($descrizione, $terminata, $user_id){
        \App\Models\Task::factory([
            'descrizione'=>$descrizione,
            'terminata'=>$terminata,
            'user_id'=>$user_id
        ])->create();
    }
    public $guarded = ['id'];
    public function user(){ //molti a uno
        //hasOne, hanMany, belongsTo, belongsToMany
        return $this->belongsTo(User::class);
    }
    use HasFactory;
    public function scopeFilter($query, $filters){


        $query
            ->join('users', 'users.id', '=', 'user_id')
            ->where('team_id','=', $filters['team']);
        
        $query->when($filters['search']?? false, fn()=>
            $query
                ->where('descrizione', 'like', '%' . $filters['search'] . '%')
                ->orWhere('name', 'like', '%'.$filters['search'] . '%')
                ->get()
        );

        
    }
}
