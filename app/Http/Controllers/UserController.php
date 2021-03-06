<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Profile;
use HttpOz\Roles\Models\Role;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    public function indexTeam(){  
        return view('auth.index',[
          'users' => User::filter(
            [
                'team' => auth()->user()->team->id,
                'search'=> request('search'),
                'teamleader'=> request('teamleader'),
                'onetask'=> request('onetask'),
                'zerotask' => request('zerotask'),
                'noCF'=> request('noCF')
            ]
        )->get()
        ]
     );
    }
    public function index(){
        return view('auth.index', 
        [
            'users' => User::filter(
                [
                    'search'=> request('search'),
                    'teamleader'=> request('teamleader'),
                    'onetask'=> request('onetask'),
                    'zerotask' => request('zerotask'),
                    'noCF'=> request('noCF')
                ]
            )->get()
        ]
    );
    }
    public function create(){
        return view('auth.sing-in',
    [
        'teams'=> Team::all()
    ]
    );
    }
    /**
     * Create new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {   
        $attributes = $request->validated();
        $attributes['password'] = bcrypt($attributes['password']);
        $user = User::addNew($attributes);    
        auth()->login($user);
        return redirect()->intended('/');
    }

    public function login(){
        return view('auth.login');
    }
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function editRoles(User $user){
        return view('auth.editroles', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }
    
    public function updateRoles(RoleRequest $request, User $user){
        
        foreach(Role::all() as $role){
            if(isset($request[$role->slug])){
                $user->attachRole($role->id);
            }else{
                $user->detachRole($role->id);
            }
        }
            
        
        return redirect('/admin');
    }
}
