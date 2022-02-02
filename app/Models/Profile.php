<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'cognome',
        'indirizzo',
        'codice_fiscale',
        'cellulare',
        'sede',
        'ruolo',
        'ddn'
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

    public static function addNew($attributes)
    {
        auth()->user()->profile()->create($attributes)->save();
    }

    use HasFactory;
}
