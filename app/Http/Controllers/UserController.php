<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use HttpOz\Roles\Models\Role;
use Facade\FlareClient\Http\Response;

class UserController extends Controller
{
    public function indexTeam(){
        $users = auth()->user()->team->members()->get();
        return view('auth.index',
      [
          'users' => $users
      ]  
    );
    }
    public function index(){
        return view('auth.index', 
        [
            'users' => User::all()
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
    public function store(Request $request)
    {   
        $attributes = $request->validate([
            'name'=>'required|max:255|min:5',
            'email'=>'required|email|max:255|min:5|unique:users,email',
            'password'=>'required|max:255|min:6',
            'team_id'=>''
        ]);
        $attributes['password'] = bcrypt($attributes['password']);
        $user = User::addNew($attributes);
        $profile = 
        auth()->login($user);
        return redirect()->intended('/');
    }
    public function login(){
        return view('auth.login');
    }
    public function authenticate()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' =>  'required',
        ]);

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
    
    public function updateRoles(Request $request, User $user){
        
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
