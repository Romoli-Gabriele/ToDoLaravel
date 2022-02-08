<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use HttpOz\Roles\Traits\HasRole;
use HttpOz\Roles\Contracts\HasRole as HasRoleContract;
use function PHPUnit\Framework\returnValueMap;

class User extends Authenticatable implements HasRoleContract
{
    use HasApiTokens, HasFactory, Notifiable, HasRole;

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
    public function assignedTasks()
    {
        return $this->hasMany(Task::class);
    }
    public function profile()
    {
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

    public static function addNew($attributes)
    {
        $user = new User($attributes);
        $user->team()->associate($attributes['team_id']);
        $user->save();
        $user->profile()->create($attributes);
        $user->save();
        return $user;
    }
    public function scopeFilter($query, $filters)
    {
        $query->when(
            $filters['teamleader'] ?? false,
            fn () =>
            $query->whereHas('roles', function ($query) {
                $query->where('role_id', '=', '2');
            })->get()
        );
        $query->when(
            $filters['onetask'] ?? false,
            fn () =>
            $query->whereDoesntHave('tasks', function ($query) {
                $query->where('terminata', 'true');
            })->get()
        );

    }
}
