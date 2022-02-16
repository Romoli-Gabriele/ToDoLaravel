<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Mail\assignedTask;
use App\Mail\doneTask;
use \HttpOz\Roles\Models\Role;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $tasks = [
                'tasks' => Task::filter(
                    [
                        'search' => request('search'),
                    ]
                )->get(),
            ];
        } else {
            $tasks = [
                'tasks' =>  auth()->user()->team->tasks()->filter(
                    [
                        'search' => request('search'),
                    ]
                )->get(),
            ];
        }
        return view('tasks.index', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = null;
        if (auth()->user()->isAdmin()) {
            $users = User::all();
            $users->forget(auth()->user()->id - 1);
        } else if (auth()->user()->isTeamleader()) {
            $users = auth()->user()->team->members()->get();
        }
        return view(
            'tasks.add-task',
            [
                'users' => $users
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->isTeamleader()) {
            $assigned = request('assigned');
            $team = auth()->user()->team;
        } else if(auth()->user()->isAdmin()){
            $assigned = request('assigned');
            $team = User::find($assigned)->team;
        }else{
            $assigned = auth()->user()->id;
            $team = auth()->user()->team;
        }
        
        Task::addNew(request('descrizione'), auth()->user(), $team, $assigned);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = null;
        if (auth()->user()->isAdmin() || auth()->user()->isTeamleader()){
            $users = $task->team->members;
        }
        return view(
            'tasks.edit',
            [
                'task' => $task,
                'users' => $users
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if (auth()->user()->isAdmin()||auth()->user()->isTeamleader()) {
            $assigned = request('assigned');
        } else if(isset($request['assigned'])){
            $assigned = auth()->user()->id;
        }
        try {
            $task->assigned()->associate(User::findOrFail($assigned));
            Mail::to(User::find($assigned))->send(new assignedTask($task));
        } catch (Exception $e) {
            $task->assigned()->dissociate();
        }
        if (isset($request['terminata']) && isset($task->assigned)) {
            $task->terminata = true;
            $leaderRole = Role::findBySlug('teamLeader');
            $leaders = $leaderRole->users;
            foreach($leaders as $leader){
                if($task->team_id == $leader->team_id){
                    var_dump($leader);
                    Mail::to($leader)->send(new doneTask($task, $task->assigned));
                }
            }
        } else {
            $task->terminata = false;
        }
        $task->descrizione = request('descrizione');
        $task->save();
        return redirect('/');
    }
    public static function delete()
    {
        if (auth()->user()->isAdmin()) {
            return view(
                'tasks.delete',
                [
                    'tasks' =>  Task::where('terminata', 1)->filter(
                        [
                            'search' => request('search'),
                        ]
                    )->get(),
                ]
            );
        } else if (auth()->user()->isTeamleader()) {
            return view(
                'tasks.delete',
                [
                    'tasks' =>  Task::where('terminata', 1)->filter(
                        [
                            'search' => request('search'),
                            'team' => auth()->user()->team->id,
                        ]
                    )->get(),
                ]
            );
        } else {
            return redirect('/');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (auth()->user()->isAdmin() || auth()->user()->isTeamleader()) {
            $task->delete();
            if(auth()->user()->isAdmin()){
                return redirect('/admin/delete');
            }else{
                return redirect('/delete');
            }
        } else {
            abort(403);
        }
    }
}
