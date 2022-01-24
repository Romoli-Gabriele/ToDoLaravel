<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'descrizione',
        'terminata',
        'user_id'
    ];
    public static function addNew($descrizione){
        \App\Models\Task::factory([
            'descrizione'=>$descrizione,
            'terminata'=>false,
            'user_id'=> auth()->user()->id,
            'team_id'=> auth()->user()->team_id,
        ])->create();
    }

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
    public function getId(){
        return $this->id;
    }
}
