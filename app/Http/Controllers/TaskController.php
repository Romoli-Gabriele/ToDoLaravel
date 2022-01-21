<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        return view(
            'tasks.index',
            [
                'tasks' =>  Task::first()->filter(
                    [
                        'search' =>request('search'),
                        'team' =>auth()->user()->team->id,
                    ]
                )->get(),
            ]
        );
    }

    public static function create()
    {
        return view('tasks.add-task');
    }
    public static function store()
    {
        Task::addNew($_POST['descrizione'], false, Auth::id());
        return redirect('/');
    }
    public static function edit(Task $task)
    {
        
        return view(
            'tasks.edit',
            [
                'task' => $task
            ]
        );
    }
    public static function update(Request $request, Task $task)
    {
        /*if ($request->user()->cannot('update', $task)) {
            abort(403);
        }*/

        if (isset($_POST['terminata'])) {
            $task->terminata = true;
        } else {
            $task->terminata = false;
        }
            $task->update([
                'descrizione' => $_POST['descrizione']
            ]);
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
    public static function destroy(Task $task)
    {
        if(auth()->user()->isLeader()){
        $task->delete();
        return redirect('/admin/delete');
        }else{
            return redirect('/');
        }
    }
}
