<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mail\assignedTask;
use Illuminate\Support\Facades\Mail;

class Task extends Model
{
    protected $fillable = [
        'descrizione',
        'terminata',
    ];
    protected $guarded = [
        'id',
        'user_id',
        'team_id',
        'assigned_id'
    ];

    public static function addNew($descrizione, $user, $team, $assigned)
    {
        $task = new Task([
            'descrizione' => $descrizione,
            'terminata' => false,
        ]);
        $task->team()->associate($team);
        $task->user()->associate($user)->save();
        if(isset($assigned)){
            $assigned = User::find($assigned);
            $task->assigned()->associate($assigned)->save();
            Mail::to($assigned)->send(new assignedTask($task));
        }
    }

    public function user()
    { //molti a uno
        //hasOne, hanMany, belongsTo, belongsToMany
        return $this->belongsTo(User::class);
    }
    public function assigned(){
        return $this->belongsTo(User::class);
    }

    public function team()
    { //molti a uno
        //hasOne, hanMany, belongsTo, belongsToMany
        return $this->belongsTo(Team::class);
    }

    use HasFactory;
    public function scopeFilter($query, $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn () =>
            $query
                ->where('descrizione', 'like', "%{$filters['search']}%")
                ->orWhereHas('user', fn ($query) => $query
                    ->where('name', 'like', "%{$filters['search']}%"))
                ->get()
        );
        $query->when(
            $filters['team'] ?? false,
            fn()=>
            $query
                ->where('team_id', 'like', $filters['team'])->get()
        );
    }
    public function getId()
    {
        return $this->id;
    }
}
