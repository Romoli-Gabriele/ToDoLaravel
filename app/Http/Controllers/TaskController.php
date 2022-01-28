<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return view('tasks.add-task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Task::addNew(request('descrizione'));
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
        return view(
            'tasks.edit',
            [
                'task' => $task
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
    public function update(Request $request,Task $task)
    {
        if (isset($request['descrizione'])) {
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
        if(auth()->user()->isLeader()){
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
        );}else{
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
