<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'indirizzo',
        'codice_fiscale',
        'cellulare',
        'sede',
        'ruolo'
    ];

    protected $guarded = [
        'id',
        'user_id'
    ];

    public function user()
    { //uno a uno
        //hasOne, hanMany, belongsTo, belongsToMany
        return $this->hasOne(User::class);
    }

    public static function addNew($indirizzo, $codice_fiscale, $cellulare, $sede, $ruolo, $user)
    {
        $profile = new Profile([
            'indirizzo' => $indirizzo,
            'codice_fiscale' => $codice_fiscale,
            'cellulare' => $cellulare,
            'sede' => $sede,
            'ruolo' => $ruolo
        ]);
        $profile
            ->user()->associate($user)
            ->save();
    }

    use HasFactory;
}
