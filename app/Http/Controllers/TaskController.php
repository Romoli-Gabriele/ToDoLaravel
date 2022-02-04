<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Exception;


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
        } else if (auth()->user()->isLeader()) {
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
        if (request('assigned') && auth()->user()->isLeader() == false) {
            $assigned = auth()->user()->id;
        } else {
            $assigned = request('assigned');
        }
        Task::addNew(request('descrizione'), auth()->user(), auth()->user()->team, $assigned);
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
        if (auth()->user()->isAdmin()) {
            $users = User::all();
        }else if(auth()->user()->isLeader()){
            $users = auth()->user()->team->members()->get();
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
        if (request('assigned') && auth()->user()->isLeaderOrAdmin() == false ) {
            $assigned = auth()->user()->id;
        } else {
            $assigned = request('assigned');
        }
        try {
            $task->assigned()->associate(User::findOrFail($assigned));
        } catch (Exception $e) {
            $task->assigned()->dissociate();
        }
        if (isset($request['terminata']) && isset($task->assigned)) {
            $task->terminata = true;
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
        } else if (auth()->user()->isLeader()) {
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
        if (auth()->user()->isLeader()) {
            $task->delete();
            return redirect('/delete');
        } else {
            return redirect('/');
        }
    }
}
