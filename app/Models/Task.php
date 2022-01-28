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
    protected $guarded = [
        'id',
        'user_id',
        'team_id'
    ];

    public static function addNew($descrizione, $user, $team)
    {
        $task = new Task([
            'descrizione' => $descrizione,
            'terminata' => false,
        ]);
        $task
            ->team()->associate($team)
            ->user()->associate($user)
            ->save();
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
