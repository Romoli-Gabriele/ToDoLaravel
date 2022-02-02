<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use function PHPUnit\Framework\returnValueMap;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $guarded = [
        'id',
        'team_id',
        'profile_id'
    ];
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isLeader()
    {
        if ($this->id == $this->team->team_leader)
            return true;
        else
            return false;
    }
    public static function addNew($attributes)
    {
        $user = new User($attributes);
            $user->team()->associate($attributes['team_id'])
            ->save();
        return $user;
    }
}
