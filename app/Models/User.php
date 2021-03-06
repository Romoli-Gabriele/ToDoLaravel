<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use HttpOz\Roles\Traits\HasRole;
use HttpOz\Roles\Contracts\HasRole as HasRoleContract;


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
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_id');
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
            $filters['team'] ?? false,
            fn()=>
            $query
                ->where('team_id', 'like', $filters['team'])->get()
        );
        $query->when(
            $filters['search'] ?? false,
            fn()=>
            $query
                ->where('name', 'like', "%{$filters['search']}%")->get()
        );
        $query->when(
            $filters['teamleader'] ?? false,
            fn () =>
            $query->whereHas('roles', function ($query) {
                $query->where('slug', '=', 'teamleader');
            })->get()
        );
        $query->when(
            $filters['onetask'] ?? false,
            fn () =>
            $query->whereIn(
                'users.id',
                fn ($query) =>
                $query->select('assigned_id')->from('tasks')
            )
        );
        $query->when(
            $filters['zerotask'] ?? false,
            fn () =>
            $query->whereNotIn(
                'users.id',
                fn ($q) =>
                $q->select('assigned_id')->from('tasks')
            )
        );
        $query->when(
            $filters['noCF'] ?? false,
            fn () =>
            $query->whereHas('profile',
            fn($query)=>
                $query->whereNull('codice_fiscale')
            )
        );
    }
}
