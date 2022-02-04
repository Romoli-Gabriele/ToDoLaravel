<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Exception;

use function GuzzleHttp\Promise\task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()){
            return view(
                'tasks.index',
                [
                    'tasks' => Task::filter(
                        [
                            'search' =>request('search'),
                        ]
                    )->get(),
                ]
            );
        }
        return view(
            'tasks.index',
            [
                'tasks' =>  auth()->user()->team->tasks()->filter(
                    [
                        'search' =>request('search'),
                    ]
                )->get(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->isLeader()){
            
            return view('tasks.add-task',  
            [
                'users'=> auth()->user()->team->members()->get()
            ]);
        }else{
            return view('tasks.add-task');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request('assigned') && auth()->user()->isLeader() == false){
            $assigned = auth()->user()->id;
        }else{
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
        if(auth()->user()->isLeader()){
            
            return view('tasks.edit',  
            [
                'task' => $task,
                'users'=> auth()->user()->team->members()->get()
            ]);
        }else{
            return view(
                'tasks.edit',
                [
                    'task' => $task
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Task $task)
    {
        if (isset($request['terminata'])) {
            $task->terminata = true;
        } else {
            $task->terminata = false;
        }
        if(request('assigned') && auth()->user()->isLeader() == false){
            $assigned = auth()->user()->id;
        }else{
            $assigned = request('assigned');
        }
        try{
            $task->assigned()->associate(User::findOrFail($assigned));
        }catch(Exception $e){
            $task->assigned()->dissociate();
        }
            $task->descrizione = request('descrizione');
            $task->save();
            return redirect('/');
    }
    public static function delete()
    {   
        if(auth()->user()->isAdmin()){
        return view(
            'tasks.delete',
            [
                'tasks' =>  Task::where('terminata', 1)->filter(
                    [
                        'search' =>request('search'),
                    ]
                )->get(),
            ]
        );
        }else if(auth()->user()->isLeader()){
            return view(
                'tasks.delete',
                [
                    'tasks' =>  Task::where('terminata', 1)->filter(
                        [
                            'search' =>request('search'),
                            'team' =>auth()->user()->team->id,
                        ]
                    )->get(),
                ]
            );
        }
        else{
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
        if(auth()->user()->isLeader()){
            $task->delete();
            return redirect('/delete');
            }else{
                return redirect('/');
            }
    }
}
