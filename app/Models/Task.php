<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'descrizione',
        'terminata',
    ];
    
    public static function addNew($descrizione)
    {
        \App\Models\Task::factory([
            'descrizione' => $descrizione,
            'terminata' => false,
            'user_id' => auth()->user()->id,
            'team_id' => auth()->user()->team_id,
        ])->create();
    }

    public function user()
    { //molti a uno
        //hasOne, hanMany, belongsTo, belongsToMany
        return $this->belongsTo(User::class);
    }

    public function team()
    { //molti a uno
        //hasOne, hanMany, belongsTo, belongsToMany
        return $this->belongsTo(User::class);
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
    }
    public function getId()
    {
        return $this->id;
    }
}
